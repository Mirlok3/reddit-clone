<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Backend\SubredditController;
use App\Http\Controllers\Backend\SubredditPostController;
use App\Http\Controllers\Frontend\SubredditController as FrontendSubredditController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/r/{slug}', [FrontendSubredditController::class, 'show'])->name('frontend.subreddits.show');

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/dashboard/subreddits', SubredditController::class);
    Route::resource('/dashboard/subreddits.posts', SubredditPostController::class);
});

require __DIR__.'/auth.php';
