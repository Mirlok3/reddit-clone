<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Backend\SubredditController;
use App\Http\Controllers\Frontend\PostCommentController;
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
Route::get('/r/{subreddit_slug}/posts/{post:slug}', [PostController::class, 'show'])->name('frontend.subreddits.posts.show');
Route::post('/r/{subreddit_slug}/posts/{post:slug}/comments', [PostCommentController::class, 'store'])->name('frontend.posts.comments');

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::resource('/subreddits', SubredditController::class);
    Route::resource('/subreddits.posts', SubredditPostController::class);
});

require __DIR__.'/auth.php';
