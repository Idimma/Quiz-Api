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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Question::inRandomOrder()->get();
        if(\request()->isMethod('post')){
            if(request()->type){
                $quiz = Question::where('class', request()->type)->inRandomOrder()->get();
            }
        }else{
            if(request()->type){
                $quiz = Question::where('class', request()->type)->inRandomOrder()->get();
            }
        }

        return response()->json([
            'data' => $quiz
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\questions $questions
     * @return \Illuminate\Http\Response
     */
    public function show(questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\questions $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\questions $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\questions $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(questions $questions)
    {
        //
    }
}
