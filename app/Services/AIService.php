<?php

namespace App\Services;

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
            ($instructions ? "### Instructions & Extra Contxt:\n{$instructions}". PHP_EOL . PHP_EOL  : "") .
            "**Response Format:** Return only a JSON object in the following format: {'similarity_score': 85}" . PHP_EOL .
            "- Do not include explanations, justifications, or extra text." . PHP_EOL .
            "- Ensure the score is between 0 and 100." . PHP_EOL;


        $payload = [
            'model' => 'llama3.2',
            'prompt' => $prompt,
            'stream' => false,
            'format' => 'json',
            'temperature' => 0.2, // Lower for consistency; higher adds creativity
            'max_tokens' => 200,  // Limit response length to prevent unnecessary text
            'top_p' => 0.9,  // Controls diversity; lower for more deterministic output
            'frequency_penalty' => 0.0, // No penalty for repeating words
            'presence_penalty' => 0.0 // No bias against introducing new words
        ];

        try {
            $response = Http::post(env('OLLAM_LINK','http://localhost:11434/api/generate'), $payload);

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

}