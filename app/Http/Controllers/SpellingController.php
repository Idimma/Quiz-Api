<?php

namespace App\Http\Controllers;

use App\Spelling;
use Illuminate\Http\Request;

class SpellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Spelling::inRandomOrder()->limit(10)->get();
        if(\request()->isMethod('post')){
            $quiz = Spelling::where('class', request()->type)->inRandomOrder()->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\spelling  $spelling
     * @return \Illuminate\Http\Response
     */
    public function show(spelling $spelling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\spelling  $spelling
     * @return \Illuminate\Http\Response
     */
    public function edit(spelling $spelling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\spelling  $spelling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, spelling $spelling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\spelling  $spelling
     * @return \Illuminate\Http\Response
     */
    public function destroy(spelling $spelling)
    {
        //
    }
}
