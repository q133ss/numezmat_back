<?php

namespace App\Http\Resources\ProfileController;

use Illuminate\Http\Resources\Json\JsonResource;

class GetCoinResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'id' => $this->id
        ];
    }
}
