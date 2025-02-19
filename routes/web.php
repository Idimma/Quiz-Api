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


use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'welcome']);
Route::get('/instructions', [QuizController::class, 'instructions']);
Route::get('/instructions/{phone}', [QuizController::class, 'instructions']);
Route::post('/create', [QuizController::class, 'store']);
Route::any('/quiz-test/{student:user_id}', [QuizController::class, 'quizTest']);



Route::post('/quiz', [QuizController::class, 'quiz']);
Route::any('/quiz/{student:user_id}', [QuizController::class, 'quiz']);
Route::any('/quiz/{student:user_id}/{type}', [QuizController::class, 'quiz']);
Route::get('/process', [QuizController::class, 'process']);
Route::get('/process-questions', [QuizController::class, 'processQuestions']);
Route::get('/completed/{player}', [QuizController::class, 'completed']);
Route::get('/quiz', fn() => redirect('/'));
Route::get('/table', [QuizController::class, 'leaderBoard']);
Route::get('/insert', [QuestionsController::class, 'insert']);
Route::post('/insert', [QuestionsController::class, 'create']);
Route::get('/insert/edit/{question}', [QuestionsController::class, 'edit']);
Route::post('/insert/edit/{question}', [QuestionsController::class, 'update']);
Route::resource('paragraphs', 'ParagraphController');
Route::post('/spellings', [QuizController::class, 'storeSpelling']);
Route::get('/spellings', [QuizController::class, 'spellings']);
