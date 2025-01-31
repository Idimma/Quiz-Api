<?php

namespace App\Http\Controllers;

use App\Question;
use App\questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $quiz = Question::inRandomOrder()->get();
        if (\request()->isMethod('post')) {
            if (request()->type) {
                $quiz = Question::where('class', request()->type)->inRandomOrder()->get();
            }
        }
        return response()->json(['data' => $quiz]);
    }

}
