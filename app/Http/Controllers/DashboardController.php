<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $item = TransactionItem::get();
        $coffee_amount = Coffee::count();
        $sold = $item->sum('quantity');
        $revenue = $item->sum('subtotal');
        return response()->json(
            [
                'amount' => $coffee_amount,
                'sold' => $sold,
                'revenue' => $revenue,
            ],200
        );
    }

    
}
