<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "customer_email"=> $this->customer_email,
            "customer_name"=>asset( $this->customer_name),
            "customer_country"=>$this->customer_country,
            "customer_phone"=>$this->customer_phone,
            "customer_address"=>$this->customer_address,
            "customer_city"=>$this->customer_city,
            "user"=>new UserResource($this->whenLoaded('user')),
              "productOrder"=>ProductOrderResource::collection($this->whenLoaded('productOrder')),



            // "subCategories"=> SubCategoryResource::collection($this->whenLoaded('subCategories')),
        ];
    }
}
