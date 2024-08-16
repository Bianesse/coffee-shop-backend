<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coffee;
use App\Models\CartItem;
use App\Models\Transaction;
use App\Service\CountPrice;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'money' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        $cart = CartItem::with(["carts","coffees"])->get();
        if (CartItem::where("cartId", 'CART01')->count() <= 0) {
            return response()->json(['message' => 'Cart Cant Be Empty!']);
        }

        $total = 0;
        foreach ($cart as $item) {
            $sum = $item->subtotal;
            $total+=$sum;
        }

        if ($request->money < $total){
            return response()->json(['message' => 'Your payment is not enough']);
        }
        
        $code = "ORD".rand(0,2000);

        $transaction = Transaction::create([
            "orderId" => $code,
            "total" => $total,
            "paymentAmount" => $request->money,
            "change" => $request->money-$total,
        ]);

        foreach ($cart as $v){
            $transactionItem = TransactionItem::create([
            "orderId" => $code,
            "coffeeId" => $v->coffeeId,
            "size" => $v->size,
            "quantity" => $v->quantity,
            "subtotal" => $v->subtotal,
        ]);
        $itemSave[] = $transactionItem;
        }
        

        $removeCart = CartItem::where('cartId', 'CART01')->delete();
        return response()->json([
            'detail' => $transaction,
            'item' => $itemSave,
        ]);
    }
}
