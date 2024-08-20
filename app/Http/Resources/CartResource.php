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
        $count = new CountPrice();
        $total = 0;

        foreach ($this->get() as $item) {
            $sub = $item->subtotal;
            $total+=$sub;
        }

        return 
        [
            'cartId' => $this->cartId,
            'coffeeName' => $this->coffees->name,
            'size' => $this->size,
            'price' => $count->price($this, false),
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
            'total' => $total,
        ];
    }
}
