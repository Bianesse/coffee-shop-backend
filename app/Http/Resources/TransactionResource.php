<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'orderId' => $this->orderId,
            'name' => $this->users->name,
            'total' => $this->total,
            'paymentAmount' => $this->paymentAmount,
            'change' => $this->change,
            'paymentMethod' => ucfirst($this->payment_method),
            'transactionDate' => $this->transaction_date,
            'items' => TransactionItemResource::collection($this->transactionItems ?? []),
        ];
    }
}
