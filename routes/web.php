<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Backend\PostVoteController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Backend\SubredditController;
use App\Http\Controllers\Frontend\PostCommentController;
use App\Http\Controllers\Backend\SubredditPostController;
use App\Http\Controllers\Frontend\SubredditController as FrontendSubredditController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/r/{slug}', [FrontendSubredditController::class, 'show'])->name('frontend.subreddits.show');
Route::get('/r/{subreddit_slug}/posts/{post:slug}', [PostController::class, 'show'])->name('frontend.subreddits.posts.show');
Route::post('/r/{subreddit_slug}/posts/{post:slug}/comments', [PostCommentController::class, 'store'])->name('frontend.posts.comments');

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::resource('/subreddits', SubredditController::class);
    Route::resource('/subreddits.posts', SubredditPostController::class);

    Route::post('/posts/{post:slug}/upVote', [PostVoteController::class, 'upVote'])->name('posts.upVote');
    Route::post('/posts/{post:slug}/downVote', [PostVoteController::class, 'downVote'])->name('posts.downVote');
});

require __DIR__.'/auth.php';
