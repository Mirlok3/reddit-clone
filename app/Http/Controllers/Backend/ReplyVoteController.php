<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\ReplyVote;

class ReplyVoteController extends Controller
{
    public function upVote(Reply $reply)
    {
        $isVoted = ReplyVote::where('reply_id', $reply->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === -1) {
                $isVoted->update(['vote' => 1]);
                $reply->increment('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === 1) {
                $isVoted->update(['vote' => null]);
                $reply->decrement('votes', 1);
                return redirect()->back();
            }elseif ($isVoted->vote === null){
                $isVoted->update(['vote' => 1]);
                $reply->increment('votes', 1);
            }

        } else {
            ReplyVote::create([
                'reply_id' => $reply->id,
                'user_id' => auth()->id(),
                'vote' => 1
            ]);
            $reply->increment('votes', 1);
            return redirect()->back();
        }
    }

    public function downVote(Reply $reply)
    {
        $isVoted = ReplyVote::where('reply_id', $reply->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === 1) {
                $isVoted->update(['vote' => -1]);
                $reply->decrement('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === -1) {
                $isVoted->update(['vote' => null]);
                $reply->increment('votes', 1);
                return redirect()->back();
            }elseif ($isVoted->vote === null){
                $isVoted->update(['vote' => -1]);
                $reply->decrement('votes', 1);
            }

        } else {
            ReplyVote::create([
                'reply_id' => $reply->id,
                'user_id' => auth()->id(),
                'vote' => -1
            ]);
            $reply->decrement('votes', 1);
            return redirect()->back();
        }
    }
}
