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


use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'welcome']);
Route::get('/create', [QuizController::class, 'create']);
Route::post('/create', [QuizController::class, 'store']);
Route::post('/', [QuizController::class, 'quizEntry']);
Route::post('/quiz', [QuizController::class, 'quiz']);
Route::get('/process', [QuizController::class,  'process']);
Route::get('/completed/{id}', [QuizController::class, 'completed']);


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

