<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoffeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //$review = $this->ratings()->select('id','rating','review')->get();
        return 
        [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'image' => $this->image,
            'rate' => $this->rate,
            'price' => $this->prices->map(function ($prices){
                return
                [
                    'size' => $prices->size,
                    'price' => $prices->price,
                ];
            }),
        ];
    }
}
