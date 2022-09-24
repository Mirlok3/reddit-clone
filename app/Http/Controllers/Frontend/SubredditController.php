<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubredditPostResource;

class SubredditController extends Controller
{
    function show($slug)
    {
        $subreddit = Subreddit::where('slug', $slug)->first();
        $posts = SubredditPostResource::collection($subreddit->posts()->paginate(12));

        return Inertia::render('Frontend/Subreddits/Show', compact('subreddit', 'posts'));
    }
}
