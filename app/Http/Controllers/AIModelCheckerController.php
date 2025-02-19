<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use Illuminate\Http\Request;

class AIModelCheckerController extends Controller
{
    public function evaluate(Request $request)
    {
        $request = request();
        $answer = $request->answer;
        $question = $request->question;
        $userAnswer = $request->user_answer;
        $instruction = $request->instruction;

        $similarityPercentage = AIService::evaluate($question, $answer, $userAnswer, $instruction);
        return response()->json([
            'similarity_percentage' => $similarityPercentage,
            'evaluation_result' => $similarityPercentage >= 80 ? 'Correct' : 'Incorrect',
        ]);
    }
}
