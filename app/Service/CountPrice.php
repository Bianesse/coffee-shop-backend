<?php
namespace App\Service;

use App\Models\Price;

class CountPrice
{
    public function price($call, $subtotal)
    {
        if ($subtotal){
            return Price::where('size', $call->size)->where('coffee_id', $call->coffees->id)->pluck('price')->first() * $call->quantity;

        }else{
            return Price::where('size', $call->size)->where('coffee_id', $call->coffees->id)->pluck('price')->first();
        }
        
    }

    public function price_request($call, $subtotal, $id)
    {
        if ($subtotal){
            return Price::where('size', $call->size)->where('coffee_id', $id)->pluck('price')->first() * $call->quantity;

        }else{
            return Price::where('size', $call->size)->where('coffee_id', $id)->pluck('price')->first();
        }
        
    }
}