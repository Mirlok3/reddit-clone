<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'comment_id',
        'post_id',
        'votes',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->belongsTo(Comment::class);
    }

    public function replyVotes()
    {
        return $this->hasMany(ReplyVote::class);
    }

    use HasFactory;
}
