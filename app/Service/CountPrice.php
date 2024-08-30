<?php

namespace App\Service;

use App\Models\Price;

class CountPrice
{
    public function price($call, $subtotal)
    {
        if ($subtotal) {
            return Price::where('size', $call->size)->where('coffee_id', $call->coffees->id)->pluck('price')->first() * $call->quantity;
        } else {
            return Price::where('size', $call->size)->where('coffee_id', $call->coffees->id)->pluck('price')->first();
        }
    }

    public function price_request($call, $subtotal, $id)
    {
        if ($subtotal) {
            return Price::where('size', $call->size)->where('coffee_id', $id)->pluck('price')->first() * $call->quantity;
        } else {
            return Price::where('size', $call->size)->where('coffee_id', $id)->pluck('price')->first();
        }
    }

    public $response;
    public function cart_update_subtotal($increment, $cart)
    {
        if ($cart) {
            if ($increment) {
                $cart->quantity += 1;
            } else {
                if ($cart->quantity > 1){
                    $cart->quantity -= 1;
                }else{
                    return $this->response = response()->json([
                        'success' => false,
                        'message' => 'Quantity cant be less that 1'
                    ], 404);
                }
            }
            $cart->save();

            $subtotal = $this->price_request($cart, true, $cart->coffeeId);

            $cart->subtotal = $subtotal;
            $cart->save();

            $this->response = response()->json([
                'success' => true,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
            ]);
        } else {
            $this->response = response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }
    }

    public function cart_select($cart)
    {
        if ($cart) {
            if ($cart->selected == true) {
                $cart->selected = false;
                $cart->save();
            } else {
                $cart->selected = true;
                $cart->save();
            }

            $this->response = response()->json([
                'success' => true,
                'selected' => $cart->selected,
            ]);
        } else {
            $this->response = response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }
    }
}
