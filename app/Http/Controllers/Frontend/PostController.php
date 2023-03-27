<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Subscribe;
use Inertia\Inertia;
use App\Models\Subreddit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostShowResource;
use App\Http\Resources\SubredditResource;

class PostController extends Controller
{
    public function show($subreddit_slug, $slug)
    {
        $subreddit = Subreddit::where('slug', $subreddit_slug)->first();

        $subreddit_post = Post::with(['comments', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->first();

        $post = new PostShowResource($subreddit_post);

        $subreddits = SubredditResource::collection(Subreddit::withCount('subscribers','posts')->orderBy('subscribers_count', 'desc')->take(6)->get());

        $can_update = Auth::check() ? Auth::user()->can('update', $subreddit_post) : false;
        $can_delete = Auth::check() ? Auth::user()->can('delete', $subreddit_post) : false;
        $ifUserSubscribed = Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', auth()->id())->count();

        return Inertia::render('Frontend/Posts/Show', compact('subreddit', 'post', 'subreddits','can_update' ,'can_delete', 'ifUserSubscribed'));
    }
}
