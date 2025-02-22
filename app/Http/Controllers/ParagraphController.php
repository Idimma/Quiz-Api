<?php

namespace App\Http\Controllers;

use App\BlankParagraph;
use Illuminate\Http\Request;

class ParagraphController extends Controller
{

    public function index()
    {
        $questions = BlankParagraph::latest()->get();
        return view('paragraph-insert', ['questions' => $questions]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'level' => 'nullable|string',
            'type' => 'nullable|string',
            'meta' => 'nullable|string',
            'student_instruction' => 'nullable|string',
            'ai_instruction' => 'nullable|string',
        ]);
        $validated['type'] = "bible";
        $validated['level'] = "level 1";
        if ($request->has('bible_ref')) {
            $validated['meta'] = ['bible_ref' => $request->bible_ref];
        }
        BlankParagraph::create($validated);
        return redirect('/paragraphs')->with('success', 'Question created successfully');
    }


    public function show(Request $request, $blankParagraph)
    {
        $blankParagraph = BlankParagraph::findOrFail($blankParagraph);
        $questions = BlankParagraph::latest()->get();
        return view('paragraph-insert', ['questions' => $questions, 'question' => $blankParagraph]);
    }


    public function edit(Request $request, BlankParagraph $blankParagraph)
    {
        $questions = BlankParagraph::latest()->get();
        return view('paragraph-insert', ['questions' => $questions, 'question' => $blankParagraph]);
    }


    public function update(Request $request, $id)
    {
        $blankParagraph = BlankParagraph::findOrFail($id);
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'level' => 'nullable|string',
            'type' => 'nullable|string',
            'meta' => 'nullable|string',
            'student_instruction' => 'nullable|string',
            'ai_instruction' => 'nullable|string',
        ]);
        if ($request->has('bible_ref')) {
            $meta = is_array($blankParagraph->meta) ? $blankParagraph->meta : [];
            $meta['bible_ref'] = $request->bible_ref;
            $validated['meta'] = $meta;
        }

        $blankParagraph->update($validated);
        return redirect('/paragraphs')->with('success', 'Question updated successfully');
    }


}
