<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Subscribe;
use Inertia\Inertia;
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
        }])->withCount('comments', 'replies')->orderBy('votes', 'desc')->take(12)->paginate(4));

        $subreddits = SubredditResource::collection(Subreddit::withCount('subscribers', 'posts')->orderBy('subscribers_count', 'desc')->take(6)->get());

        return Inertia::render('Welcome', compact('posts', 'subreddits'));
    }

    public function subscribed()
    {
        $subscribed = Subscribe::where('user_id', auth()->id())->pluck('subreddit_id');

        $posts = SubredditPostResource::collection(Post::with(['user','subreddit', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->whereIn('subreddit_id', $subscribed)->withCount('comments', 'replies')->orderBy('votes', 'desc')->take(12)->paginate(4));

        $subreddits = SubredditResource::collection(Subreddit::withCount('subscribers', 'posts')->orderBy('subscribers_count', 'desc')->take(6)->get());

        return Inertia::render('Welcome', compact('posts', 'subreddits'));
    }
}
