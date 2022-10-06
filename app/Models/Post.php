<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;
use App\Models\Subreddit;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'subreddit_id',
        'title',
        'slug',
        'description',
        'url',
        'votes',
    ];

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subreddit()
    {
        return $this->belongsTo(Subreddit::class);
    }

    public function postVotes()
    {
        return $this->hasMany(Vote::class);
    }
}
