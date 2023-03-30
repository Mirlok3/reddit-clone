<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Subreddit;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PostCommentController extends Controller
{
    public function store($subreddit_slug, Post $post)
    {
        Request::validate([
            'content' => ['required','max:255'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => Request::input('content'),
        ]);

        return back();
    }

    public function edit($subreddit_slug, $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        $sub_name = Subreddit::where('slug', $subreddit_slug)->first('name');

        return Inertia::render('Subreddits/Posts/Comments/Edit', compact('subreddit_slug', 'post', 'comment', 'sub_name'));
    }

    public function update($subreddit_slug, $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update(Request::validate([
            'content' => ['required','max:255'],
        ]));

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit_slug, $post])->with('message', 'Comment edited succesfuly!');
    }

    public function destroy($subreddit_slug, $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('message', 'Comment deleted succesfully.');
    }
}
