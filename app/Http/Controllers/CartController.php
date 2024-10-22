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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $count = new CountPrice();
        $price = $count->price_request($request, false, $id);
        $user = auth()->user();
        
        $cartitem = CartItem::where('coffeeId', $id)->where('size', $request->size)->where('user_id', $user->id)->first();
        if (!empty($cartitem)) {
            if ($cartitem->coffeeId == $id && $cartitem->size == $request->size) {
                $newQty = $cartitem->quantity + $request->quantity;
                $cartitem->quantity = $newQty;
                $cartitem->subtotal = $newQty * $price;
                $cartitem->save();
                return response()->json($cartitem);
            }
        }

        $add = CartItem::create([
            "user_id" => $user->id,
            'coffeeId' => $id,
            'size' => strtoupper($request->size),
            'quantity' => $request->quantity,
            'subtotal' => $request->quantity * $price,
        ]);

        return response()->json($add);
    }

    public function show()
    {
        $cart = CartItem::with(["users", "coffees"])->where('user_id', auth()->user()->id)->get();

        return new CartCollection($cart);
    }

    public function increase($id)
    {
        $cart = CartItem::find($id);
        $subtotal = new CountPrice();
        $subtotal->cart_update_subtotal(true, $cart);

        return $subtotal->response;
    }

    public function decrease($id)
    {
        $cart = CartItem::find($id);
        $subtotal = new CountPrice();
        $subtotal->cart_update_subtotal(false, $cart);

        return $subtotal->response;
    }

    public function delete($id)
    {
        $cart = CartItem::find($id);
        if ($cart) {
            $cart->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully removed cart item',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cart item not found or failed to remove item'
        ], 400);
        
    }

    public function select($id)
    {
        $cart = CartItem::find($id);
        $select = new CountPrice();
        $select->cart_select($cart);

        return $select->response;
    }
}
