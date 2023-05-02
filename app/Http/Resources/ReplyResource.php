<?php

namespace App\Http\Resources;

use App\Models\Subscribe;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'user_id' => $this->user_id,
            'comment_id' => $this->comment_id,
            'post_slug' => $this->post->slug,
            'subreddit_slug' => $this->post->subreddit->slug,
            'votes' => $this->votes,
            'username' => $this->user->username,
            'user_image' => $this->user->user_image,
            'content' => $this->content,
            'commentVotes' => $this->whenLoaded('replyVotes'),
            'created_at' => $this->created_at->diffForHumans(),
            'role' => Subscribe::where('user_id', $this->user_id)
                ->where('subreddit_id', $this->post->subreddit->id)->value('role'),
        ];
    }
}
