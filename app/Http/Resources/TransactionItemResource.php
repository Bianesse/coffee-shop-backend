<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'orderId' => $this->orderId,
            'size' => $this->size,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
            'coffee' => [
                'name' => $this->coffees->name,
                'price' => $this->coffees->priceForSize($this->size)->price,
            ]
        ];
    }
}
