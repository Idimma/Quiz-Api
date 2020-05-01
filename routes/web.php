<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use TCG\Voyager\Facades\Voyager;

Route::get('/', static function () {
    return view('welcome');
});
Route::get('/create', static function () {
    return view('create-student');
});
Route::post('/create', static function () {
    $user_id = 'LP69-Q-' . (\App\Student::count() + 1);
    $user = \App\Student::create([
        'user_id' => $user_id,
        'name' => request()->name,
        'class' => request()->class,
        'zone' => request()->zone,
    ]);
    return view('user', ['user' => $user]);
});

Route::post('/', static function () {
    $user = \App\Student::where('user_id', request()->user_id)->first();
    if($user){
        $instruction = \App\Configurations::where('age_group', $user->class)->get();
        return view('dashboard', [
            'name' => $user->name,
            'user_id' => $user->user_id,
            'class' => $user->class,
            'types' => $user->types,
            'zone' => $user->zone,
            'instructions' => $instruction
        ]);
    }
    return redirect('/')->with('error', 'Student not Found');
});

Route::post('/quiz', static function () {
    if (request()->type === 'Multiple Options') {
        return view('multiple-options', request()->all());
    }
    return view('spelling-bee', request()->all());
});
Route::get('/process', static function () {
    $answers = (array)json_decode(request()->answers, true);
    $keys = array_keys($answers);

    $player = \App\Players::create(
        [
            'questions' => $keys,
            'name' => request()->name,
            'score' => request()->got,
            'class' => request()->class,
            'zone' => request()->zone,
            'answers' => $answers
        ]
    );
    return redirect("completed/$player->id");
});
Route::get('/completed/{id}', static function ($id) {
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
});


Route::get('/quiz', function () {
    return redirect('/');
});


Route::get('/table', function () {
    return view('tables');
});
Route::get('/insert', function () {
    return view('insert');
});

Route::post('/insert', function () {
    return view('tables');
});


Route::get('/spell', function () {
    return view('spell_welcome');
});
Route::get('/spell/{user}', function ($user) {

    return view('spell', ['user' => $user, 'no' => 1, 'score' => 0]);
});

Route::get('/spell/{user}/{no}', function ($user, $no) {
    return view('spell', ['user' => $user, 'no' => $no, 'score' => 0]);
});

Route::post('/spelling', function () {
    $name = ucwords(request()->name);
    return redirect("spell/$name/1");
});

Route::post('/spell-insert', function () {
    $word = request()->spell;
    $s = new \App\spelling();
    $s->word = ucwords($word);
    $s->user = '';
    $s->is_right = 0;
    $s->answer = '';
    $s->save();
    return redirect("spell-insert");
});

Route::get('/spell-insert', function () {

    return view('spell_insert');
});


Route::post('/spell', function () {
    $spell = request()->spell;
    $user = request()->user;
    $no = request()->no;
    $score = request()->score;

    $list = ['jesus', 'lord', 'hosea'];

    if ($no < count($list)) {
        //Perform Action
        if (ucfirst($list[$no - 1]) === ucfirst($spell)) {
            $score = $score + 1;
        }
        return view('spell', ['user' => $user, 'no' => $no + 1, 'score' => $score]);
    } else {
        return view('done', ['user' => $user, 'no' => $no, 'score' => $score]);
    }

});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
