<?php

namespace App\Http\Controllers\Backend;

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
}
