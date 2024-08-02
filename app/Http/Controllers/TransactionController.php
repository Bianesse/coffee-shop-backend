<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coffee;
use App\Models\Transaction;
use Illuminate\Http\Request;
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

        $cart = Cart::with("coffees")->get();
        $total = 0;
        foreach ($cart as $item) {
            $sum = $item->coffees->price * $item->amount;
            $total+=$sum;
        }

        if ($request->money < $total){
            return response()->json(['message' => 'Your payment is not enough']);
        }
        
        $code = "ORD".rand(0,2000);

        $transaction = Transaction::create([
            "orderId"=> $code,
            "total"=> $total,
        ]);

        $removeCart = Cart::truncate();
        return response()->json($transaction);
    }
}
