<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;

Route::view('/', 'main.main');
Route::view('/about', 'main.Aboutus');
Route::view('/login', 'main.login');
Route::view('/profile', 'main.profile');
Route::view('/quize', 'main.quizA');
Route::view('/signup', 'main.signup');
Route::view('/test', 'main.test');
Route::view('/track', 'main.Track');


Route::post('/signup', [Users::class, 'store']);
Route::post('/login', [Users::class, 'show']);
