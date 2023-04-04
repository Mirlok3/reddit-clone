<?php

use App\Http\Controllers\Backend\SubscribeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Backend\PostVoteController;
use App\Http\Controllers\Backend\CommentVoteController;
use App\Http\Controllers\Backend\ReplyVoteController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Backend\SubredditController;
use App\Http\Controllers\Frontend\PostCommentController;
use App\Http\Controllers\Backend\SubredditPostController;
use App\Http\Controllers\Frontend\SubredditController as FrontendSubredditController;
use App\Http\Controllers\Frontend\ReplyController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/r/{slug}', [FrontendSubredditController::class, 'show'])->name('frontend.subreddits.show');
Route::get('/r/{subreddit_slug}/posts/{post:slug}', [PostController::class, 'show'])->name('frontend.subreddits.posts.show');

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::resource('/r/{subreddit_slug}/posts/{post:slug}/comments', PostCommentController::class);
    Route::resource('/r/{subreddit_slug}/posts/{post:slug}/comments/{comment:id}/replies', ReplyController::class);
    Route::resource('/subreddits', SubredditController::class);
    Route::resource('/subreddits.posts', SubredditPostController::class);

    Route::resource('/profile', UserController::class);

    Route::post('/posts/{post:slug}/upVote', [PostVoteController::class, 'upVote'])->name('posts.upVote');
    Route::post('/posts/{post:slug}/downVote', [PostVoteController::class, 'downVote'])->name('posts.downVote');
    Route::post('/comments/{comment:id}/upVote', [CommentVoteController::class, 'upVote'])->name('comments.upVote');
    Route::post('/comments/{comment:id}/downVote', [CommentVoteController::class, 'downVote'])->name('comments.downVote');
    Route::post('/replies/{reply:id}/upVote', [ReplyVoteController::class, 'upVote'])->name('replies.upVote');
    Route::post('/replies/{reply:id}/downVote', [ReplyVoteController::class, 'downVote'])->name('replies.downVote');

    Route::get('subreddits/{subreddit:slug}/subscribe', [SubscribeController::class, 'subscribe'])->name('subreddits.subscribe');

});

require __DIR__.'/auth.php';
