<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create($subreddit_slug, Post $post, Comment $comment)
    {
        $creator = User::where('id', $comment->id)->get();
        return Inertia::render('Subreddits/Posts/Comments/Replies/Create', compact('comment', 'creator', 'subreddit_slug', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($subreddit_slug, Post $post, Comment $comment)
    {
        Request::validate([
            'content' => ['required','max:255'],
        ]);
        $comment->replies()->create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => Request::input('content'),
        ]);

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit_slug, $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Inertia\Response
     */
    public function edit($subreddit_slug, $post, Comment $comment, Reply $reply)
    {
        $this->authorize('update', $reply);
        $creator = User::where('id', $comment->id)->get();

        return Inertia::render('Subreddits/Posts/Comments/Replies/Edit', compact('subreddit_slug', 'post', 'comment','reply', 'creator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($subreddit_slug, $post, Comment $comment, Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->update(Request::validate([
            'content' => ['required','max:255'],
        ]));

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit_slug, $post])->with('message', 'Reply edited succesfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($subreddit_slug, $post, Comment $comment, Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return back()->with('message', 'Reply deleted succesfully.');
    }
}
