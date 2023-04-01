<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostShowResource extends JsonResource
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
            'url' => $this->url,
            'votes' => $this->votes,
            'post_file' => $this->post_file,
            'file_ext' => pathinfo(storage_path($this->post_file), PATHINFO_EXTENSION),
            'postVotes' => $this->whenLoaded('postVotes'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
