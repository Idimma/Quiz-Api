<?php

namespace App\Services;

use App\Player;
use Illuminate\Support\Facades\Http;

class AIService
{
    public static function evaluate($question, $answer, $userAnswer, $instructions = '')
    {

        $question = trim($question);
        $answer = trim($answer);
        $userAnswer = trim($userAnswer);

        $prompt = "You are an AI specialized in evaluating the accuracy of responses based on meaning rather than exact wording. Compare the user's response to the correct answer and determine how closely their meaning aligns,, synonyms, and alternative phrasing" . PHP_EOL . PHP_EOL .
            "### Task:" . PHP_EOL .
            "Evaluate how similar the meaning of the User's Response is to the Correct Answer, considering synonyms, context, and alternative phrasing." . PHP_EOL . PHP_EOL .
            "### Question Context:\n{$question}" . PHP_EOL .
            "### Correct Answer:\n{$answer}" . PHP_EOL .
            "### User's Response:\n{$userAnswer}" . PHP_EOL . PHP_EOL .
            "### Evaluation Criteria:" . PHP_EOL .
            "- Use the **question context** to understand if the user's response is relevant" . PHP_EOL .
            "- Consider the **meaning** of the response, not just the exact words." . PHP_EOL .
            "- Allow for variations in phrasing, synonyms, or alternative correct responses." . PHP_EOL .
            "- If the response is mostly correct but slightly incomplete, deduct points accordingly." . PHP_EOL .
            "- If the response is entirely incorrect or unrelated, give a very low score." . PHP_EOL . PHP_EOL .
            "- If the response and the answer are single words and they both match in lowercase give 100 as score." . PHP_EOL . PHP_EOL .
            ($instructions ? "### Instructions & Extra Contxt:\n{$instructions}" . PHP_EOL . PHP_EOL : "") .
            "**Response Format:** Return only a JSON object in the following format: {'similarity_score': 85}" . PHP_EOL .
            "- Do not include explanations, justifications, or extra text." . PHP_EOL .
            "- Ensure the score is between 0 and 100." . PHP_EOL;


        $payload = [
            'model' => 'llama3.2',
            'prompt' => $prompt,
            'stream' => false,
            'format' => 'json',
//            'temperature' => 0.5, // Lower for consistency; higher adds creativity
//            'max_tokens' => 200,  // Limit response length to prevent unnecessary text
//            'top_p' => 0.9,  // Controls diversity; lower for more deterministic output
//            'frequency_penalty' => 0.0, // No penalty for repeating words
//            'presence_penalty' => 0.0 // No bias against introducing new words
        ];

        try {
            $response = Http::post(env('OLLAM_LINK', 'http://localhost:11434/api/generate'), $payload);

            if ($response->successful()) {
                $result = $response->json();
                $similarityObj = json_decode(trim($result['response']), true);
                return isset($similarityObj['similarity_score']) ? (float)$similarityObj['similarity_score'] : 0;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function openAIGenerate($aiQuestions)
    {
        // Construct the prompt for OpenAI
        $prompt = "You are an AI specialized in evaluating the accuracy of responses based on meaning rather than exact wording. Compare the user's response to the correct answer and determine how closely their meaning aligns.\n\n";

        foreach ($aiQuestions as $item) {
            $prompt .= "### Question Index: {$item['index']}\n";
            $prompt .= "### Question Context:\n{$item['question']}\n";
            $prompt .= "### Correct Answer:\n{$item['answer']}\n";
            $prompt .= "### User's Response:\n{$item['given_answer']}\n";
            if (!empty($item['instruction'])) {
                $prompt .= "### Instructions & Extra Context:\n{$item['instruction']}\n";
            }
            $prompt .= "### Evaluation Criteria:\n";
            $prompt .= "- Use the **question context** to understand if the user's response is relevant.\n";
            $prompt .= "- Consider the **meaning** of the response, not just the exact words.\n";
            $prompt .= "- Allow for variations in phrasing, synonyms, or alternative correct responses.\n";
            $prompt .= "- If the response is mostly correct but slightly incomplete, deduct points accordingly.\n";
            $prompt .= "- If the response is entirely incorrect or unrelated, give a very low score.\n";
            $prompt .= "- If the response and the answer are single words and they both match in lowercase, give 100 as the score.\n\n";
        }

        $prompt .= "**Response Format:** Return only a JSON object where each index maps to a similarity score.\n";
        $prompt .= "Example: {\"0\": 85, \"1\": 72, \"2\": 100}\n";
        $prompt .= "- Do not include explanations, justifications, or extra text.\n";
        $prompt .= "- Ensure the score is between 0 and 100.\n";

        $payload = [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'You are an AI evaluator that strictly returns JSON responses.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.5,
            'max_tokens' => 200,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', $payload);

            if ($response->successful()) {
                $result = $response->json();
                $similarityObj = json_decode($result['choices'][0]['message']['content'], true);
                return is_array($similarityObj) ? $similarityObj : [];
            }
        } catch (\Exception $e) {
            return [];
        }

        return [];
    }


    public static function analyze(Player $player)
    {
        if (!$player->ai_marked) {
            $questions = $player->questions ?? [];
            $quests = array_filter($questions, fn($question) => $question['question_type'] === 'paragraph');

            $aiQuestions = [];
            foreach ($quests as $index => $question) {
                $aiQuestions[] = [
                    'index' => $index,
                    'question' => $question['question'],
                    'answer' => $question['answer'],
                    'given_answer' => $question['given_answer'],
                    'instruction' => $question['instruction'] ?? '',
                ];
            }

            $scores = self::openAIGenerate($aiQuestions);
            if (count($scores)) {
                foreach ($scores as $index => $percent) {
                    $questions[$index]['ai_score'] = $percent;
                    $questions[$index]['score'] = $percent < 1 ? 0 : ($percent * $quests[$index]['mark']) / 100;
                    $questions[$index]['correct'] = $quests[$index]['score'] > 0;
                    $questions[$index]['color'] = self::getColor($percent);
                }
                $player->questions = $questions;
                $player->ai_marked = true;
                $player->save();
            }
        }
    }

    public static function getColor($score = null)
    {
        if ($score === null) return '#808080';
        if ($score < 1) return '#FF0000';
        if ($score < 20) return '#FF4500';
        if ($score > 20 && $score < 50) return '#FFA500';
        if ($score > 40 && $score < 60) return '#FFD700';
        if ($score > 60 && $score < 80) return '#90EE90';
        if ($score > 80 && $score < 90) return '#32CD32';
        return '#008000';
    }

    public static function calculateScores(mixed $questions)
    {
        foreach ($questions as $index => $question) {
            $color = '';
            $score = 0;
            $question['ai_score'] = 0;

            if (in_array($question['question_type'], ['multiple_choice', 'spelling'])) {
                $color = '#FF0000';
                try {
                    $s = $question['given_answer'];
                }catch(\Exception $exception){
                    logs()->info("missing coloumn", $question);
                }

                if (str($question['expected_answer']??'')->lower()->trim()->toString() == str($question['given_answer']??'')->trim()->lower()->toString()) {
                    $score = $question['mark'];
                    $color = AIService::getColor(100);
                    $question['ai_score'] = 100;
                }
            }

            if ($question['question_type'] === 'paragraph') {
                $question['ai_score'] = 'pending';;
                $score = 0;
                $color = AIService::getColor(null);
            }

            $question['score'] = $score;
            $question['correct'] = $score > 0;
            $question['color'] = $color;
            $questions[$index] = $question;
        }



        return $questions;
    }

    public static function recalculate(mixed $questions)
    {
        foreach ($questions as $index => $question) {
            $color = '';
            $score = 0;
            $question['ai_score'] = 0;

            if (in_array($question['question_type'], ['multiple_choice', 'spelling'])) {


                $color = '#FF0000';
                if (str($question['expected_answer']??'')->lower()->trim()->toString() == str($question['given_answer'] ??'')->trim()->lower()->toString()) {
                    $score = $question['mark'];
                    $color = AIService::getColor(100);
                    $question['ai_score'] = 100;
                }
            }

            if ($question['question_type'] === 'paragraph') {
                $question['ai_score'] = 'pending';;
                $score = 0;
                $color = AIService::getColor(null);
            }

            $question['score'] = $score;
            $question['correct'] = $score > 0;
            $question['color'] = $color;
            $questions[$index] = $question;
        }


        $quests = array_filter($questions, fn($question) => $question['question_type'] === 'paragraph');

        $aiQuestions = [];
        foreach ($quests as $index => $question) {
            $aiQuestions[] = [
                'index' => $index,
                'question' => $question['question'],
                'answer' => $question['answer'],
                'given_answer' => $question['given_answer'],
                'instruction' => $question['instruction'] ?? '',
            ];
        }

        $scores = self::openAIGenerate($aiQuestions);
        if (count($scores)) {
            foreach ($scores as $index => $percent) {
                $questions[$index]['ai_score'] = $percent;
                $questions[$index]['score'] = $percent < 1 ? 0 : ($percent * $quests[$index]['mark']) / 100;
                $questions[$index]['correct'] = $quests[$index]['score'] > 0;
                $questions[$index]['color'] = self::getColor($percent);
            }
        }


        return $questions;
    }


}