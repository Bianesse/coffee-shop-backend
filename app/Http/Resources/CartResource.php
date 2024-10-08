<?php

namespace App\Http\Resources;

use App\Models\Price;
use App\Service\CountPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total = 0;

        foreach ($this->get() as $item) {
            if($item->selected == false){ continue; };
            if($item->user_id != auth()->user()->id){ continue; };
            $sub = $item->subtotal;
            $total+=$sub;
        }

        return 
        [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'coffeeName' => $this->coffees->name,
            'size' => $this->size,
            'price' => $this->coffees->priceForSize($this->size)->price,//$count->price($this, false),
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
            'selected' => $this->selected,
            'total' => $total,
        ];
    }
}
