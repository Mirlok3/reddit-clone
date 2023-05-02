<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Subreddit;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubredditResource;
use App\Http\Resources\SubredditPostResource;

class SubredditController extends Controller
{
    function show($slug)
    {
        $subreddit = Subreddit::withCount('posts')->where('slug', $slug)->firstOrFail();
        $posts = SubredditPostResource::collection($subreddit->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments', 'replies')->orderBy('votes', 'desc')->paginate(5));

        $subreddits = SubredditResource::collection(Subreddit::withCount('subscribers','posts')->orderBy('subscribers_count', 'desc')->take(6)->get());
        $ifUserSubscribed = Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', auth()->id())->count();
        $can_delete = Auth::check() ? Auth::user()->can('delete', $subreddit->id) : false;

        return Inertia::render('Frontend/Subreddits/Show',
            compact('subreddit', 'posts', 'subreddits', 'ifUserSubscribed', 'can_delete')
        );
    }
}
