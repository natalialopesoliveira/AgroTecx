<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "title" => $this->title,
            "user_id" => $this->user_id,
            "status" => $this->status,
            "description" => $this->description,
            "price" => $this->price,
        ];
    }
}
