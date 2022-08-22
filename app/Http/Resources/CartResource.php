<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "quantity"=> $this->quantity,
            "sum"=>$this->sum,
            "product"=>new ProductResource($this->whenLoaded('product')),
            "user"=>new UserResource($this->whenLoaded('user')),


            // "subCategories"=> SubCategoryResource::collection($this->whenLoaded('subCategories')),
        ];

    }
}
