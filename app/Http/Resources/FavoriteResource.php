<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'name' => $this->users->name,
                'role' => $this->users->roles->roleName,
                //'coffee' => $this->coffees->id,
                'coffee_name' => $this->coffees->name,
                'type' => $this->coffees->type,
                'description' => $this->coffees->description,
                'image' => url('storage/' . $this->coffees->image),
                'rate' => $this->coffees->rate,
                'rate_total' => $this->coffees->rate_total,
                'price' => $this->coffees->prices->map(function ($prices) {
                    return
                        [
                            'size' => $prices->size,
                            'price' => $prices->price,
                        ];
                }),

            ];
    }
}
