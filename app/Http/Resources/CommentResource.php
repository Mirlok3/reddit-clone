<?php

namespace App\Http\Resources;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Subscribe;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'votes' => $this->votes,
            'username' => $this->user->username,
            'user_image' => $this->user->user_image,
            'post_slug' => $this->post->slug,
            'subreddit_slug' => $this->post->subreddit->slug,
            'content' => $this->content,
            'commentVotes' => $this->whenLoaded('commentVotes'),
            'replies' => ReplyResource::collection(Reply::with(['replyVotes' => function ($query) {
                $query->where('user_id', auth()->id());
            }])->where('comment_id', $this->id)->get()), // TODO: See more pagination
            'created_at' => $this->created_at->diffForHumans(),
            'role' => Subscribe::where('user_id', $this->user_id)
                ->where('subreddit_id', $this->post->subreddit->id)->value('role'),
        ];
    }
}
