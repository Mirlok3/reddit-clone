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
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subreddits()
    {
        return $this->belongsTo(Subreddit::class, 'subreddit_id');
    }
}
