<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\Post';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

         return  [
            'data' => Post::collection($this->collection),
            'data' => $this->collection,
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'current' => $this->currentPage(),
                'last' => $this->lastPage(),
                'base' => $this->url(1),
                'next' => $this->nextPageUrl(),
                'prev' => $this->previousPageUrl()
            ],
            // 'links' =>[
            //     'self' =>'link-value'
            // ],
            // 'other' =>[
            //     'self2' => 'link-value2'
            // ]
         ];
    }
}
