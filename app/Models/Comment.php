<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'votes',
        'content',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscribe()
    {
        return $this->belongsTo(Subscribe::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function commentVotes()
    {
        return $this->hasMany(CommentVote::class);
    }
}
