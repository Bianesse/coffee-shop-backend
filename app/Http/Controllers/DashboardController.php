<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // Get all items and their total quantity and subtotal
         $items = TransactionItem::with('coffees')->get(); // Eager load the coffee relationship
     
         // Calculate totals
         $coffeeCount = Coffee::count();
         $totalSold = $items->sum('quantity');
         $revenue = Transaction::sum('total');
     
         // Most and least popular coffee in one query using aggregate functions
         $popularity = TransactionItem::select('coffeeId')
             ->selectRaw('SUM(quantity) as total_sold')
             ->groupBy('coffeeId')
             ->orderBy('total_sold', 'desc')
             ->get();
     
         $mostPopularCoffee = $popularity->first(); // Most popular
         $leastPopularCoffee = $popularity->last(); // Least popular (if exists)

         if ($mostPopularCoffee) {
            $mostPopularCoffee->name = Coffee::find($mostPopularCoffee->coffeeId)->name ?? 'N/A';
        }
        
        if ($leastPopularCoffee) {
            $leastPopularCoffee->name = Coffee::find($leastPopularCoffee->coffeeId)->name ?? 'N/A';
        }
     
         // Find never purchased coffees
         $neverPurchasedCoffees = Coffee::leftJoin('transaction_items', 'coffees.id', '=', 'transaction_items.coffeeId')
             ->whereNull('transaction_items.coffeeId')
             ->select('coffees.name')
             ->get();
     
         // Monthly revenue
         $monthlyRevenue = Transaction::select(
             DB::raw('YEAR(transaction_date) as year'),
             DB::raw('MONTH(transaction_date) as month'),
             DB::raw('SUM(total) as total_revenue')
         )
         ->groupBy('year', 'month')
         ->orderBy('year', 'asc')
         ->orderBy('month', 'asc')
         ->get();
     
         // Revenue by payment method
         $revenueByPaymentMethod = Transaction::select(
             'payment_method',
             DB::raw('SUM(total) as total_revenue')
         )
         ->groupBy('payment_method')
         ->orderBy('total_revenue', 'desc')
         ->get();
     
         // Return the JSON response
         return response()->json([
             'amount' => $coffeeCount,
             'sold' => $totalSold,
             'revenue' => $revenue,
             'most_popular' => $mostPopularCoffee,
             'least_popular' => $leastPopularCoffee,
             'never_purchased' => $neverPurchasedCoffees,
             'monthly_revenue' => $monthlyRevenue,
             'revenue_by_payment_method' => $revenueByPaymentMethod
         ], 200);
     }
     
}
