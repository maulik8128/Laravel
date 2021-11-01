<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         parent::toArray($request);

         return [
            'id' => $this->id,
            'content' => $this->content,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id
         ];
    }
}
