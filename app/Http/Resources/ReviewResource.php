<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'reviews' => $this->ratings->map(function ($reviews) {
                return
                [
                    'id'=> $reviews->id,
                    'coffee_name' => $this->name,
                    'reviewer' => $reviews->reviewers->name,
                    'rating' => $reviews->rating,
                    'review' => $reviews->review,
                ];
            })
        ];
    }
}
