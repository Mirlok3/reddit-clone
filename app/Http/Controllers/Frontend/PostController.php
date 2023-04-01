<?php

namespace App\Http\Controllers\Frontend;

use App\Models\CommentVote;
use App\Models\Post;
use App\Models\Subscribe;
use Inertia\Inertia;
use App\Models\Subreddit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostShowResource;
use App\Http\Resources\SubredditResource;
use function _PHPStan_d279f388f\React\Promise\all;

class PostController extends Controller
{
    public function show($subreddit_slug, $slug)
    {
        $subreddit = Subreddit::withCount('posts')->where('slug', $subreddit_slug)->firstOrFail();

        $subreddit_post = Post::with(['comments', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->first();

        $commentVote = CommentVote::where('user_id', auth()->id())->get();

        $post = new PostShowResource($subreddit_post);

        $subreddits = SubredditResource::collection(Subreddit::withCount('subscribers','posts')->orderBy('subscribers_count', 'desc')->take(6)->get());

        $can_update = Auth::check() ? Auth::user()->can('update', $subreddit_post) : false;
        $can_delete = Auth::check() ? Auth::user()->can('delete', $subreddit_post) : false;
        $ifUserSubscribed = Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', auth()->id())->count();

        return Inertia::render('Frontend/Posts/Show',
            compact('subreddit', 'post', 'subreddits','can_update' ,'can_delete', 'ifUserSubscribed', 'commentVote'
        ));
    }
}
