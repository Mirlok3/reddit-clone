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
        // Image save
        if ($request->hasFile('post_image')) {
            $imagename = $request->post_image->getClientOriginalName();
            $request->post_image->move(public_path("post_images"), $imagename);
            $path = '/post_images/' . $imagename;
            $request->post_image = $path;
            $subreddit->save();
        }

        $subreddit->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'post_image' => $request->post_image,
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

        if ($request->hasFile('post_image')) {
            $imagename = $request->post_image->getClientOriginalName();
            $request->post_image->move(public_path("post_images"), $imagename);
            $path = '/post_images/' . $imagename;
            $post->post_image = $path;
            $post->save();
        }

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit->slug, $post->slug]);
    }

    public function destroy(Subreddit $subreddit, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return Redirect::route('frontend.subreddits.show', $subreddit->slug);
    }
}
