<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIModelCheckerController extends Controller
{
    public function evaluate(Request $request)
    {
        $similarityPercentage = $this->percentageOfCorrectness();
        return response()->json([
            'similarity_percentage' => $similarityPercentage,
            'evaluation_result' => $similarityPercentage >= 80 ? 'Correct' : 'Incorrect',
        ]);
    }


    private function percentageOfCorrectness()
    {
        $request = request();
        $answer = $request->answer;
        $question = $request->question;
        $userAnswer = $request->user_answer;


        $prompt = "You are an AI specialized in evaluating answer accuracy. Compare the user's response to the correct answer and return a similarity score as a percentage. " . PHP_EOL . PHP_EOL .
            "### Question:\n{$question}" . PHP_EOL .
            "### Correct Answer:\n{$answer}" . PHP_EOL .
            "### User's Response:\n{$userAnswer}" . PHP_EOL . PHP_EOL . PHP_EOL .
            "- Provide only a numerical similarity score between 0 and 100." . PHP_EOL .
            "- Response with JSON using this example format {'similarity_score': 70}". PHP_EOL ;

        $payload = [
            'model' => 'llama3.2',
            'prompt' => $prompt,
            'stream' => false,
            'format' => 'json'
        ];

        try {
            $response = Http::post('http://localhost:11434/api/generate', $payload);

            if ($response->successful()) {
                $result = $response->json();
                $similarityObj = json_decode(trim($result['response']), true); //"{"similarity_score": 80}"
                return isset($similarityObj['similarity_score']) ? (float)$similarityObj['similarity_score'] : 0;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }
}
