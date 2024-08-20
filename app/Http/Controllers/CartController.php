<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Service\CountPrice;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'size'     => 'required', 
            'quantity'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $count = new CountPrice();
        $subtotal = $count->price_request($request, true, $id);

        $cartitem = CartItem::where('coffeeId', $id)->where('size', $request->size)->first();
        if (!empty($cartitem)){
            if ($cartitem->coffeeId == $id && $cartitem->size == $request->size){
                $cartitem->update([
                    'quantity' => $cartitem->quantity + $request->quantity
                ]);
                return response()->json($cartitem);
            }
        }
        
        $add = CartItem::create([
            'cartId' => 'CART01',
            'coffeeId' => $id,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
        ]);

        return response()->json($add);
    }

    public function show()
    {
        $cart = CartItem::with(["carts", "coffees","prices"])->get();

        return new CartCollection($cart);
    }
}
