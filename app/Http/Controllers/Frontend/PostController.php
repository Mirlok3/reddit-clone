<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show($subreddit_slug, $slug)
    {
        $subreddit = Subreddit::where('slug', $subreddit_slug)->first();
        $post = Post::where('slug', $slug)->first();

        return Inertia::render('Frontend/Posts/Show', compact('subreddit', 'post'));
    }
}
