<?php

namespace App\Http\Controllers;

class QuizController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('create-student');
    }

    public function store()
    {
        $user = \App\Student::create([
            'user_id' => request()->phone,
            'name' => request()->name,
            'class' => request()->class,
            'zone' => request()->zone,
            'types' => request()->levels
        ]);
        return view('user', ['user' => $user]);
    }

    public function quizEntry()
    {
        $user = \App\Student::where('user_id', request()->user_id)->first();
        if ($user) {
            $instruction = \App\Configurations::where('age_group', $user->class)->get();
            return view('dashboard', [
                'name' => $user->name,
                'user_id' => $user->user_id,
                'class' => $user->class,
                'types' => json_decode($user->types),
                'zone' => $user->zone,
                'instructions' => $instruction
            ]);
        }
        return redirect('/')->with('error', 'Student not Found');
    }

    public function quiz()
    {

        if (str(request()->type)->lower()->contains('multiple')) {
            return view('multiple-options', request()->all());
        }
        return view('spelling-bee', request()->all());
    }

    public function process()
    {
        $answers = (array)json_decode(request()->answers, true);
        $keys = array_keys($answers);

        $player = \App\Players::create(
            [
                'questions' => $keys,
                'name' => request()->name,
                'score' => request()->got,
                'class' => request()->class,
                'zone' => request()->zone,
                'user_id' => request()->user_id,
                'time' => request()->time_left,
                'answers' => $answers
            ]
        );
        return redirect("completed/$player->id");
    }

    public function completed($id)
    {
        $player = \App\Players::findOrFail($id);
        $questions = \App\Question::whereIn('id', $player->questions)->get();

        return view('correction', [
            'questions' => $questions->toArray(),
            'name' => $player->name,
            'score' => $player->score,
            'total' => count($questions),
            'class' => $player->class,
            'zone' => $player->zone,
            'answers' => $player->answers
        ]);

    }
}
