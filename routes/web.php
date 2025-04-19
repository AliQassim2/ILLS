<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Users;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\StoryLikeController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


//Home
Route::get('/',  function () {
    $stories = \App\Models\stories::with('user')->where('is_active', true)
        ->orderBy('created_at', 'DESC')->where('suggested', true)
        ->simplePaginate(4);
    $user = new \App\Http\Controllers\Users();
    $reading = $user->reault(Illuminate\Support\Facades\Auth::id());
    return view('main.main', compact('stories', 'reading'));
})->name('home')->middleware('verify');
Route::view('/about', 'main.Aboutus');


//Stories
Route::controller(StoriesController::class)->group(function () {
    Route::get('/stories', 'index')->name('stories')->middleware('verify');
    Route::get('/stories/{stories}', 'show')->name('stories.show')->middleware('verify');
});
//StoryComment
Route::controller(StoryCommentController::class)->group(function () {
    Route::get('/comment/{story_id}', 'index')->name('comment.index');
    Route::middleware('verify', 'auth')->group(function () {
        Route::post('/comment/{comment_id}/create', 'store')->name('comment.create');
        Route::get('/comment/{comment}/edit', 'edit')->name('comment.edit');
        Route::put('/comment/{comment_id}', 'update')->name('comment.update');
        Route::delete('/comment/{comment_id}', 'destroy')->name('comment.delete');
    });
});


//StoryLike
Route::controller(StoryLikeController::class)->group(function () {
    Route::post('/like/{id}', 'toggleLike')->middleware('verify', 'auth');
});






//Users
Route::controller(Users::class)->group(function () {
    Route::get('/rank', 'index')->name('rank');
    Route::get('/login', 'display_login')->name('login');
    Route::post('/login',  'login')->name('login.process');
    Route::post('/logout',  'logout')->middleware('auth')->name('logout');
    Route::get('/signup', 'create')->middleware('guest')->name('signup');
    Route::post('/signup', 'store')->middleware('guest')->name('signup.store');
    Route::get('/profile', 'edit')->middleware('auth')->name('profile');
    Route::patch('/profile/{user}',  'update')->middleware('auth')->name('profile.update');
    Route::get('/verify-email',  'showVerificationPage')->name('verify-email')->middleware('auth');
    Route::post('/verify-email',  'processVerification')->name('verify-email.process')->middleware('auth');
    Route::get('/verify-email/resend',  'resendVerification')->name('verify-email.resend')->middleware('auth');
    Route::get('/forgot-password', 'viewForgetPassword')->middleware('guest')->name('password.request');

    Route::post('/forgot-password', 'sendLinks')->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', 'viewResetPassword')->middleware('guest')->name('password.reset');

    Route::post('/reset-password', 'ResetPassword')->middleware('guest')->name('password.update');
});









Route::post('/save-score', function (Request $request) {
    $request->validate([
        'score' => 'required|integer',
        'story_id' => 'required|exists:stories,id'
    ]);

    \App\Models\result::create([
        'user_id' => Auth::id(), // Or handle guests if needed
        'stories_id' => $request->story_id, // match column name in your DB
        'score' => $request->score,
    ]);

    return response()->json(['message' => 'Score saved']);
})->name('save-score')->middleware('verify', 'auth');





Route::controller(DashboardController::class)->group(function () {
    Route::middleware(['verify', 'auth', 'admin'])->group(function () {
        // Users
        Route::get('/dashboard/users',  'users')->name('dashboard.users');
        Route::post('/dashboard/users/{id}/upgrade',  'upgradeToPublisher')->name('dashboard.users.upgrade');
        Route::post('/dashboard/users/{id}/downgrade',  'downgrade')->name('dashboard.users.downgrade');
        Route::post('/dashboard/users/{id}/ban',  'toggleBan')->name('dashboard.users.ban');
        Route::post('/dashboard/users/{id}/fullban',  'toggleFullBan')->name('dashboard.users.fullban');
        Route::delete('dashboard/users/{user}/delete',  'destroy')->name('dashboard.users.delete');
        Route::delete('/dashboard/stories/{id}/delete',  'deleteStory')->name('dashboard.stories.delete');
        Route::post('/dashboard/stories/{id}/suggested',  'suggested')->name('dashboard.stories.suggested');
    });
    // Stories
    Route::middleware(['verify', 'auth', 'publisher'])->group(
        function () {
            Route::get('/dashboard/stories',  'stories')->name('dashboard.stories');
            Route::get('/dashboard/stories/create',  'createStory')->name('dashboard.stories.create');
            Route::post('/dashboard/stories/store',  'storeStory')->name('dashboard.stories.store');
            Route::get('/dashboard/stories/{id}/edit',  'editStory')->name('dashboard.stories.edit');
            Route::put('/dashboard/stories/{id}/update',  'updateStory')->name('dashboard.stories.update');
            Route::post('/dashboard/stories/{id}/toggle-status',  'toggleStoryStatus')->name('dashboard.stories.toggle-status');
            Route::post('/dashboard/stories/{story}/reset-score',  'resetScore')->name('dashboard.stories.reset-score');
            // Questions
            Route::get('/dashboard/stories/{id}/questions',  'storyQuestions')->name('dashboard.stories.questions.index');
            Route::get('/dashboard/stories/{id}/questions/create',  'createQuestion')->name('dashboard.stories.questions.create');
            Route::post('/dashboard/stories/{id}/questions/store',  'storeQuestion')->name('dashboard.stories.questions.store');
            Route::get('/dashboard/questions/{question}/edit',  'editQuestion')->name('dashboard.questions.edit');
            Route::put('/dashboard/questions/{question}/update',  'updateQuestion')->name('dashboard.questions.update');
            Route::delete('/dashboard/questions/{question}/delete',  'deleteQuestion')->name('dashboard.questions.delete');
        }
    );
});
