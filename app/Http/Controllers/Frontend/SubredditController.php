<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubredditController extends Controller
{
    function show($slug)
    {
        $subreddit = Subreddit::where('slug', $slug)->first();

        return Inertia::render('Frontend/Subreddits/Show', compact('subreddit'));
    }
}
