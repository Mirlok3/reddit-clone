<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Redirect;

class SubredditPostController extends Controller
{
    public function create(Subreddit $subreddit)
    {
        return Inertia::render('Subreddits/Posts/Create', compact('subreddit'));
    }

    public function store(StorePostRequest $request, Subreddit $subreddit)
    {
        $subreddit->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return Redirect::route('frontend.subreddits.show', $subreddit->slug);
    }

    public function edit(Subreddit $subreddit, Post $post)
    {
        $this->authorize('update', $post);
        return Inertia::render('Subreddits/Posts/Edit', compact('subreddit', 'post'));
    }

    public function update(StorePostRequest $request, Subreddit $subreddit, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit->slug, $post->slug]);
    }

    public function destroy(Subreddit $subreddit, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return Redirect::route('frontend.subreddits.show', $subreddit->slug);
    }
}
