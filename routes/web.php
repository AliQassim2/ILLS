<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\StoryLikeController;
use App\Http\Controllers\QuestionsController;
//Home
Route::view('/', 'main.main');
Route::view('/about', 'main.Aboutus');
Route::view('/quize', 'main.quizA');
Route::view('/test', 'main.test');
Route::view('/track', 'main.Track');


//Stories
Route::controller(StoriesController::class)->group(function () {
    Route::get('/stories', 'index');
    Route::get('/stories/{stories}', 'show');
    Route::get('/stories/create', 'create')->middleware('auth');
    Route::post('/stories', 'store')->middleware('auth');
    Route::get('/stories/{stories}/edit', 'edit')->middleware('auth');
    Route::patch('/stories/{stories}', 'update')->middleware('auth');
    Route::delete('/stories/{stories}', 'destroy')->middleware('auth');
    Route::get('/quiz/{id}', 'quiz')->middleware('auth');
});
//StoryComment
Route::controller(StoryCommentController::class)->group(function () {
    Route::get('/story/{id}', 'index');
    Route::post('/story/{id}', 'store')->middleware('auth');
    Route::delete('/story', 'destroy')->middleware('auth');
});


//StoryLike
Route::controller(StoryLikeController::class)->group(function () {
    Route::post('/like/{id}', 'toggleLike')->middleware('auth');
});


//Questions
Route::controller(QuestionsController::class)->group(function () {
    Route::get('/questions', 'index');
    Route::get('/questions/{questions}', 'show');
    Route::get('/questions/create', 'create')->middleware('auth');
    Route::post('/questions', 'store')->middleware('auth');
    Route::get('/questions/{questions}/edit', 'edit')->middleware('auth');
    Route::patch('/questions/{questions}', 'update')->middleware('auth');
    Route::delete('/questions/{questions}', 'destroy')->middleware('auth');
});



//Users
Route::controller(Users::class)->group(function () {
    Route::get('/rank', 'index');
    Route::get('/login', 'display_login')->middleware('guest');
    Route::post('/login',  'login')->name('login')->middleware('guest');
    Route::post('/logout',  'logout')->middleware('auth');
    Route::get('/signup', 'create');
    Route::post('/signup', 'store');
    Route::get('/profile', 'edit')->middleware('auth');
    Route::patch('/profile/{user}',  'update')->middleware('auth');
});






//
