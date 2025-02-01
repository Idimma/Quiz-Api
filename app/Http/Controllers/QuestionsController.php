<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $quiz = Question::where('type', $request->get('type'))->inRandomOrder()->take(15)->get();
        return response()->json(['data' => $quiz]);
    }

}
