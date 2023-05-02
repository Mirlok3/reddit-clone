<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subreddit_id',
        'subscribe',
        'role'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subreddits()
    {
        return $this->belongsTo(Subreddit::class, 'subreddit_id');
    }
}
