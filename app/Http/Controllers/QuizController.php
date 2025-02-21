<?php

namespace App\Http\Controllers;

use App\BlankParagraph;
use App\Player;
use App\Question;
use App\Services\AIService;
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

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:11|max:11',
            'name' => 'required|string|min:3',
        ]);

        $phone = str(request()->phone)->trim()->replace('+234', '0');
        Student::updateOrCreate(['user_id' => $phone,], [
            'user_id' => $phone,
            'name' => request()->name,
            'level' => request()->level,
            'tiers' => [],
            'type' => request()->type
        ]);
        session()->put('phone', $phone);
        return redirect("instructions/$phone");
    }


    public function instructions(mixed $phone = '')
    {
        $phone = session()->get('phone', $phone);
        $user = Student::whereUserId($phone)->first();
        if ($user) {
            return view('dashboard', [
                'name' => $user->name,
                'user_id' => $user->user_id,
                'level' => $user->level,
                'tiers' => $user->tiers,
                'type' => $user->type,
            ]);
        }
        return redirect('/', ['error' => 'Student not registered']);
    }


    public function quiz(Request $request, Student $student, $type = '')
    {
        if (str($type)->lower()->contains('multiple')) {
            $questions = Question::whereType($student->type)->inRandomOrder()->take(15)->get();
            return view('multiple-options', $request->merge([
                'questions' => $questions,
                'student' => $student
            ])->all());
        }

        if (str($type)->lower()->contains('blank')) {
            $questions = BlankParagraph::whereType($student->type)->inRandomOrder()->take(15)->get();
            return view('multiple-options', $request->merge([
                'questions' => $questions,
                'student' => $student
            ])->all());
        }

        $spellings = Spelling::inRandomOrder()->take(15)->get();
        return view('spelling-bee', request()->merge(['spellings' => $spellings, 'student' => $student])->all());
    }

    public function quizTest(Request $request, Student $student)
    {
        $multipleChoice = Question::whereType('bible')->inRandomOrder()->take(20)->get()
            ->map(function ($q) {
                $answer = $q->answer;
                return array_merge($q->toArray(), [
                    'question_type' => 'multiple_choice',
                    'expected_answer' => $q->$answer,
                    'timer' => 20,
                    'mark' => 3
                ]);
            });

        $spellings = Spelling::whereType('bible')->inRandomOrder()->take(2)->get()
            ->map(fn($q) => array_merge($q->toArray(), [
                'question_type' => 'spelling',
                'timer' => 25,
                'answer' => $q->word,
                'expected_answer' => $q->word,
                'question' => "Spell " . $q->word,
                'mark' => 5
            ]));

        $paragraphs = BlankParagraph::whereType('bible')->inRandomOrder()->take(3)->get()
            ->map(fn($q) => array_merge($q->toArray(), [
                'question_type' => 'paragraph',
                'expected_answer' => $q->answer,
                'timer' => 60,
                'mark' => 10
            ]));

        $questions = collect($multipleChoice)->merge($spellings)->merge($paragraphs);
        return view('quiz-test', compact('questions', 'student'));
    }

    public function process(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['percent'] = $request->get('percent', 0);
        $validatedData['questions'] = json_decode($request->questions, true) ?? [];
        $validatedData['answers'] = json_decode($request->answers, true) ?? [];
        $validatedData['given_answers'] = json_decode($request->given_answers, true) ?? [];
        $validatedData['seconds_spread'] = json_decode($request->seconds_spread, true) ?? [];
        $validatedData['meta'] = json_decode($request->meta, true) ?? [];
        $player = Player::create($validatedData);
        return redirect("completed/$player->id");
    }

    public function processQuestions(Request $request)
    {
        $questions = $request->get('questions', []);

        foreach ($questions as $index => $question) {
            $color = '';
            $score = 0;
            $question['ai_score'] = 0;

            if (in_array($question['question_type'], ['multiple_choice', 'spelling'])) {
                $color = '#FF0000';
                if (str($question['answer'])->lower() == str($question['given_answer'])->lower()) {
                    $score = $question['mark'];
                    $color = '#008000';
                    $question['ai_score'] = 100;
                }
            }

            if ($question['question_type'] === 'paragraph') {
                $que = $question['question'];
                $answer = $question['answer'];
                $givenAnswer = $question['given_answer'];

                $mark = $question['mark'];
                //Compare by AI

                $percent = AIService::evaluate($que, $answer, $givenAnswer);

                $question['ai_score'] = $percent;
                $score = $percent < 1 ? 0 : ($percent * $mark) / 100;
                $color = AIService:: getColor($percent);

            }

            $question['score'] = $score;
            $question['correct'] = $score > 0;
            $question['color'] = $color;
            $questions[$index] = $question;
        }


//        $timers = array_map(fn($q) => $q['timer'], $questions);

        $usedTimer = array_map(fn($q) => $q['second_spent'], $questions);
        $marks = array_map(fn($q) => $q['mark'], $questions);
        $scores = array_map(fn($q) => $q['score'], $questions);
        $score = array_sum($scores);
        $percent = $score / array_sum($marks);


        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'questions' => $questions,
            'score' => $score,
            'percent' => $percent,
            'seconds_used' => array_sum($usedTimer),
            'type' => $request->type,
            'level' => $request->level,
            'question_type' => 'mixed',
        ];
        $player = Player::create($data);
        return redirect("completed/$player->id");
    }


    public function processQuestionsAi(Request $request)
    {
        $questions = $request->get('questions', []);
        $questions = AIService::calculateScores($questions);
        $usedTimer = array_map(fn($q) => $q['second_spent'] ?? $q['timer'] ?? 20, $questions);
        $marks = array_map(fn($q) => $q['mark'] ?? 0, $questions);
        $scores = array_map(fn($q) => $q['score'] ?? 0, $questions);
        $score = array_sum($scores);
        $percent = $score / array_sum($marks);

        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'questions' => $questions,
            'score' => $score,
            'percent' => $percent,
            'seconds_used' => array_sum($usedTimer),
            'type' => $request->type,
            'level' => $request->level,
            'question_type' => 'mixed',
        ];
        $player = Player::create($data);

        try {
            if (!$player->ai_marked) {
                $player->questions = AIService::recalculate($player->questions);
                $questions = $player->questions;
                $usedTimer = array_map(fn($q) => $q['second_spent'], $questions);
                $marks = array_map(fn($q) => $q['mark'], $questions);
                $scores = array_map(fn($q) => $q['score'], $questions);
                $score = array_sum($scores);
                $percent = $score / array_sum($marks);
                $data = [
                    'questions' => $questions,
                    'score' => $score,
                    'percent' => $percent,
                    'seconds_used' => array_sum($usedTimer),
                    'question_type' => 'mixed',
                ];
                $player->update($data);
                $player->ai_marked = true;
                $player->save();
                $player->refresh();
            }
        } catch (\Exception $e) {
            logs()->error("AI ERROR " . $e->getMessage());
        }


        return $player; //redirect("completed/$player->id");
    }

    public
    function completed(Player $player)
    {
        return view('correction', $player->toArray());
    }

    public
    function leaderBoard()
    {
        return view('tables');
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


    public function result(Request $request, $userId)
    {
        $player = Player::whereUserId($userId)->latest()->firstOrFail();

        if (!$player->ai_marked) {
            $player->questions = AIService::recalculate($player->questions);
            $questions = $player->questions;
            $usedTimer = array_map(fn($q) => $q['second_spent'] ?? $q['timer'] ?? 20, $questions);
            $marks = array_map(fn($q) => $q['mark'], $questions);
            $scores = array_map(fn($q) => $q['score'], $questions);
            $score = array_sum($scores);
            $percent = $score / array_sum($marks);
            $data = [
                'questions' => $questions,
                'score' => $score,
                'percent' => $percent,
                'seconds_used' => array_sum($usedTimer),
                'question_type' => 'mixed',
            ];
            $player->update($data);
            $player->ai_marked = true;
            $player->save();
            $player->refresh();
        }
        return view('correction', $player->toArray());
    }
}
