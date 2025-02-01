<?php

namespace App\Http\Controllers;

use App\Players;
use App\Question;
use App\Spelling;
use App\Student;
use Illuminate\Http\Request;

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
        $user = Student::create([
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
        $user = Student::where('user_id', request()->user_id)->first();
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

    public function quiz(Request $request, Student $student)
    {
        if (str(request()->type)->lower()->contains('multiple')) {
            $questions = Question::where('type', $student->type)->inRandomOrder()->take(15)->get();
            return view('multiple-options', $request->merge([
                'questions' => $questions,
                'student' => $student
            ])->all());
        }

        $words = Spelling::inRandomOrder()->take(15)->pluck('word')->toArray();
        return view('spelling-bee', request()->merge(['words' => $words, 'student' => $student])->all());
    }

    public function process(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['questions'] = json_decode($request->questions, true) ?? [];
        $validatedData['answers'] = json_decode($request->answers, true) ?? [];
        $validatedData['given_answers'] = json_decode($request->given_answers, true) ?? [];
        $validatedData['seconds_spread'] = json_decode($request->seconds_spread, true) ?? [];
        $validatedData['meta'] = json_decode($request->meta, true) ?? [];
        $player = Players::create($validatedData);
        return redirect("completed/$player->id");
    }

    public function completed(Players $player)
    {
        return view('correction', $player->toArray());
    }

    public function leaderBoard()
    {
        $players = Players::orderBy('percent', 'desc')->get();
        return view('tables', ['players' => $players]);
    }


    function storeSpelling(Request $request)
    {
        $data = $request->only(['word', 'type', 'level']);
        Spelling::updateOrCreate($data, $data);
        return redirect("spellings");
    }

    function spellings(Request $request)
    {
        $spellings = Spelling::get();
        return view('spell_insert', ['spellings' => $spellings]);
    }
}
