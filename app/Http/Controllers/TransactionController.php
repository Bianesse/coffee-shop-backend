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
use App\Http\Resources\CartCollection;
use function PHPUnit\Framework\isNull;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TransactionCollection;

class TransactionController extends Controller
{
    private $cart;

    public function __construct()
    {
        $this->cart = CartItem::with(['users', 'coffees'])->where('selected', 1)->where('user_id', auth()->user()->id)->get();
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'money' => 'required',
            'payment_method' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        $cart = $this->getCart();
        if ($cart->isEmpty()) {
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
        $user = auth()->user();

        $transaction = Transaction::create([
            "orderId" => $code,
            "user_id" => $user->id,
            "total" => $total,
            "paymentAmount" => $request->money,
            "change" => $request->money-$total,
            "payment_method" => $request->payment_method,
            "transaction_date" => date('Y-m-d H:i:s'),
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
        
        $cartid = $cart->pluck('id');
        CartItem::whereIn('id', $cartid)->delete();
        return response()->json([
            'detail' => $transaction,
            'item' => $itemSave,
        ]);
    }

    public function logs()
    {
        $transactions = Transaction::with('transactionItems.coffees.prices')->get();
        return new TransactionCollection($transactions);
    }

    public function view()
    {
        $cart = $this->getCart();
        return new CartCollection($cart);
    }
}
