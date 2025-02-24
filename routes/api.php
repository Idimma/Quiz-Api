<?php

use App\Http\Controllers\AIModelCheckerController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', static function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('quiz', 'QuestionsController@index');
Route::post('process-questions', [QuizController::class, 'processQuestionsAi']);
Route::get('quiz', 'QuestionsController@index');
Route::post('spelling', 'SpellingController@index');
Route::get('spelling', 'SpellingController@index');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');

Route::post('ai-evaluation', [AIModelCheckerController::class, 'evaluate']);

Route::group(['middleware' => 'auth:api'], static function () {
    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{article}', 'ArticleController@update');
    Route::delete('articles/{article}', 'ArticleController@delete');
});
