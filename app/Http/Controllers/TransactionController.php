<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coffee;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $cart = Cart::with("coffees")->get();
        $total = 0;
        foreach ($cart as $item) {
            $sum = $item->coffees->price * $item->amount;
            $total+=$sum;
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
