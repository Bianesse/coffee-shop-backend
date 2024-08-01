<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::insert([
            ["orderId" => "ORD2283", "total"=> "100000"],
            ["orderId" => "ORD2413", "total"=> "50000"],
            ["orderId" => "ORD1225", "total"=> "70000"],
        ]);
    }
}
