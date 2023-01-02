<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubredditResource;
use App\Http\Resources\SubredditPostResource;
use App\Models\Subreddit;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $posts = SubredditPostResource::collection(Post::with(['user','subreddit', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->orderBy('votes', 'desc')->take(12)->paginate(4));

        $subreddits = SubredditResource::collection(Subreddit::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        return Inertia::render('Welcome', compact('posts', 'subreddits'));
    }
}
