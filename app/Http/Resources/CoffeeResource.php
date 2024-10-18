<?php

namespace App\Http\Resources;

use App\Models\CoffeeFavorite;
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
        $user = auth()->user()->id ?? null;
        $favorite = CoffeeFavorite::where('user_id', $user)->where('coffee_id', $this->id)->exists();
        if ($favorite) {
            $favorite = true;
        } else {
            $favorite = false;
        }
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'type' => $this->type,
                'description' => $this->description,
                'image' => url('storage/' . $this->image),
                'rate' => $this->rate,
                'rate_total' => $this->rate_total,
                'price' => $this->prices->map(function ($prices) {
                    return
                        [
                            'size' => $prices->size,
                            'price' => $prices->price,
                        ];
                }),
                'favorite' => $favorite
            ];
    }
}
