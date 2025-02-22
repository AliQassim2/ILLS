<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'main.main');
Route::view('/t', 'welcome');
Route::view('/about', 'main.Aboutus');
Route::view('/login', 'main.login');
Route::view('/profile', 'main.profile', ['user' => Auth::user()]);
Route::view('/quize', 'main.quizA');
Route::view('/signup', 'main.signup');
Route::view('/test', 'main.test');
Route::view('/track', 'main.Track');


Route::post('/signup', [Users::class, 'store']);
Route::post('/login', [Users::class, 'show']);
