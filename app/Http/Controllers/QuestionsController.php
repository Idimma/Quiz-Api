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

    public function create(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'a' => 'required|string',
            'b' => 'required|string',
            'c' => 'required|string',
            'd' => 'required|string',
            'answer' => 'required|in:a,b,c,d',
            'bible_ref' => 'nullable|string',
        ]);
        $validated['type'] = "bible";
        $validated['class'] = "level 1";
        if ($request->has('bible_ref')) {
            $validated['meta'] = ['bible_ref' => $request->bible_ref];
        }

        $quiz = Question::create($validated);
        return redirect('/insert')->with('success', 'Question created successfully');
    }
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'a' => 'required|string',
            'b' => 'required|string',
            'c' => 'required|string',
            'd' => 'required|string',
            'answer' => 'required|in:a,b,c,d',
            'bible_ref' => 'nullable|string',
        ]);
        $validated['type'] = "bible";
        if ($request->has('bible_ref')) {
            $validated['meta'] = ['bible_ref' => $request->bible_ref];
        }

        $question->update($validated);
        return redirect('/insert')->with('success', 'Question updated successfully');
    }


    public function edit(Question $question)
    {
        $questions = Question::whereType('bible')->latest()->get();
        return view('insert', compact('question', 'questions'));
    }

    public function insert()
    {
        $questions = Question::whereType('bible')->latest()->get();
        return view('insert', compact('questions'));
    }
}
