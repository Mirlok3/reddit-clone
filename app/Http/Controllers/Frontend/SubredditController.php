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
        $subreddit = Subreddit::where('slug', $slug)->firstOrFail();
        $posts = SubredditPostResource::collection($subreddit->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->paginate(3));

        return Inertia::render('Frontend/Subreddits/Show', compact('subreddit', 'posts'));
    }
}
