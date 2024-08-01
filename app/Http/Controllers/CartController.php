<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
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
        $add = Cart::create([
            'coffeeId' => $id,
            'size' => $request->size,
            'amount' => $request->amount,
        ]);

        return response()->json($add);
    }

    public function show()
    {
        $cart = Cart::with("coffees")->get();

        return CartResource::collection($cart);
    }
}
