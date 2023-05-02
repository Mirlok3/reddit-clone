<?php

namespace App\Http\Controllers;

use App\Models\Subreddit;
use App\Models\Subscribe;
use Inertia\Inertia;

class SubredditUserController extends Controller
{
    public function index(Subreddit $subreddit)
    {
        $this->authorize('update', $subreddit);
        $subscribedUsers = Subscribe::with('users')->where('subreddit_id', $subreddit->id)->paginate(12);
        return Inertia::render('Subreddits/Users/Index', compact('subscribedUsers', 'subreddit'));
    }

    public function giveRole(Subreddit $subreddit, $user, $role)
    {
        $this->authorize('update', $subreddit);
        $subscribeData = Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', $user)->first();

        if ($subscribeData->role == $role) {
            $subscribeData->update(['role' => null]);
            return redirect()->back();
        }

        $subscribeData->update(['role' => $role]);
        return redirect()->back();
    }
}
