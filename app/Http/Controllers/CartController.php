<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'size'     => 'required', 
            'amount'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $add = CartItem::create([
            'cartId' => 'CART01',
            'coffeeId' => $id,
            'size' => $request->size,
            'quantity' => $request->amount,
        ]);

        return response()->json($add);
    }

    public function show()
    {
        $cart = CartItem::with(["carts", "coffees"])->get();

        return new CartCollection($cart);
    }
}
