<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        //$raw = $this->coffees()->select('name','type','price')->get();
        $subtotal = $this->coffees->price * $this->quantity;
        $total = 0;

        foreach ($this->get() as $item) {
            $sub = $item->coffees->price * $item->quantity;
            $total+=$sub;
        }

        return 
        [
            'cartId' => $this->cartId,
            'coffeeName' => $this->coffees->name,
            'size' => $this->size,
            'price' => $this->coffees->price,
            'amount' => $this->quantity,
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }
}
