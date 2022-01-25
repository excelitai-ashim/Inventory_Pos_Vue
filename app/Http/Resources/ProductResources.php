<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
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
            "id"=>$this->id,
            "category_id"  => $this->category_id, 
            "product_name"  => $this->product_name, 
            "product_code" => $this->product_code, 
            "root" => $this->root, 
            "buying_price"=> $this->buying_price,
            "selling_price"=> $this->selling_price, 
            "supplier_id" => $this->supplier_id, 
            "buying_date"=> $this->buying_date,
            "image" => asset($this->image), 
            "product_quantity"   => $this->product_quantity, 

            "category_name"  => $this->category_name->category_name,
            "supplier_name"  => $this->supplier_name->name, 
 


        ];
    }
}


