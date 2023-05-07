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
//        dd($this);
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
        ];
    }








}
