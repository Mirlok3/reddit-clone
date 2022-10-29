<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subreddit extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'slug',
        'subscribers',
        'subreddit_image',
    ];

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribe::class);
    }
}
