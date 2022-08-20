<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return[
            "id"=> $this->id,
            "name"=> $this->name,
            "photo"=>asset( $this->photo),
            "price"=>$this->price,
            "previous_price"=>$this->previous_price,


            // "subCategories"=> SubCategoryResource::collection($this->whenLoaded('subCategories')),
        ];


    }
}
