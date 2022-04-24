<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title'=>$this->title,
            'writer_id'=>$this->writer_id,
            'slug'=>$this->slug,
            'writer'=>new UserResource($this->user),
            'comments'=>CommentResource::collection($this->comments)
        ];
    }
}
