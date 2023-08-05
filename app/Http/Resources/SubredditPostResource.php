<?php

namespace App\Http\Resources;

use App\Models\Subscribe;
use Illuminate\Http\Resources\Json\JsonResource;

class SubredditPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'username' => $this->user->username,
            'user_id' => $this->user->id,
            'slug' => $this->slug,
            'votes' => $this->votes,
            'post_file' => $this->post_file,
            'file_ext' => pathinfo(storage_path($this->post_file), PATHINFO_EXTENSION),
            'postVotes' => $this->whenLoaded('postVotes'),
            'subreddit_id' => $this->subreddit->id,
            'subreddit_slug' => $this->subreddit->slug,
            'comments_count' => $this->comments_count + $this->replies_count,
            'created_at' => $this->created_at->diffForHumans(),
            'role' => Subscribe::where('user_id', $this->user_id)
                ->where('subreddit_id', $this->subreddit->id)->value('role'),
        ];
    }
}
