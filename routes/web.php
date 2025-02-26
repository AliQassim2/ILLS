<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Auth;
//Views
Route::view('/', 'main.main');
Route::view('/t', 'welcome');
Route::view('/about', 'main.Aboutus');
Route::view('/login', 'main.login');
Route::view('/quize', 'main.quizA');
Route::view('/signup', 'main.signup');
Route::view('/test', 'main.test');
Route::view('/track', 'main.Track');
//GET
Route::get('/profile', function () {
    $usersController = new Users();
    return view('main.profile', ['user' => Auth::user(), 're' => $usersController->reault(Auth::user()->id), 'sum' => $usersController->sum(Auth::user()->id)]);
});


//POST
Route::post('/signup', [Users::class, 'store']);
Route::post('/login', [Users::class, 'show']);
//PATCH
Route::patch('/profile/{id}', [Users::class, 'update']);
//DELETE
