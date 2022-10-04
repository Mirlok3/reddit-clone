<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PostCommentController extends Controller
{
    public function store($subreddit_slug, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => Request::input('content'),
        ]);

        return back();
    }
}
