<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subreddit;
use App\Models\Subscribe;
use function PHPUnit\Framework\isNull;

class SubscribeController extends Controller
{
    public function subscribe(Subreddit $subreddit)
    {
        $isSubscribed = Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', auth()->id())->first();

        if (!is_Null($isSubscribed)) {
            if ($isSubscribed->subscribe === 1) {
                Subscribe::where('subreddit_id', $subreddit->id)->where('user_id', auth()->id())->first()->delete();
                $subreddit->decrement('subscribers', 1);
                return redirect()->back();
            }
        } else {
            Subscribe::create([
                'subreddit_id' => $subreddit->id,
                'user_id' => auth()->id(),
                'subscribe' => 1
            ]);
            $subreddit->increment('subscribers', 1);
            return redirect()->back();
        }

    }
}
