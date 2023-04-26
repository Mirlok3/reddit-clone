<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Subscribe;
use Inertia\Inertia;
use App\Models\Subreddit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Redirect;

class SubredditPostController extends Controller
{
    public function create(Subreddit $subreddit)
    {
        $subs = Subscribe::with('subreddits:id,name,slug')->where('user_id', auth()->id())->get()->pluck('subreddits');
        return Inertia::render('Subreddits/Posts/Create', compact('subs', 'subreddit'));
    }

    public function store(StorePostRequest $request, Subreddit $subreddit)
    {
        if ($request->hasFile('post_file')) {
            $imagename = $request->post_file->hashName();
            $request->post_file->move(public_path("post_files"), $imagename);
            $path = '/post_files/' . $imagename;
            $request->post_file = $path;
            $subreddit->save();
        }

        $subreddit->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'post_file' => $request->post_file,
            'subreddit_id' => $request->sub,
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

        if ($request->hasFile('post_file')) {
            $imagename = $request->post_file->getClientOriginalName();
            $request->post_file->move(public_path("post_files"), $imagename);
            $path = '/post_files/' . $imagename;
            $post->post_file = $path;
            $post->save();
        }

        return Redirect::route('frontend.subreddits.posts.show', [$subreddit->slug, $post->slug])->with('message', 'Post edited succesfuly!');
    }

    public function destroy(Subreddit $subreddit, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return Redirect::route('frontend.subreddits.show', $subreddit->slug);
    }
}
