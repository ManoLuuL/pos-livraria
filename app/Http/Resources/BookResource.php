<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category->name,
            'author' => $this->author->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

