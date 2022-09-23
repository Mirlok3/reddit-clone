<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    function show($slug)
    {
        $subreddit = Subreddit::where('slug', $slug)->first();

        return Inertia::render('Communities/Show', compact('subreddit'));
    }
}
