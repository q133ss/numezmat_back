<?php

namespace App\Http\Resources\ProfileController;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class GetOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = json_decode($this->products);
        $products_formatted = [];
        foreach ($products as $product){
            $products_formatted[] =
                [
                    'title' => Product::find($product->id)->title,
                    'qty' => $product->qty
                ];
        }

        return [
            'name' => $this->fio,
            'status' => $this->status,
            'total' => $this->total,
            'email' => $this->email,
            'date' => $this->getDate(),
            'products' => $products_formatted
        ];
    }
}
