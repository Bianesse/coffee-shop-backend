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
            [
                'orderId' => 'ORD232',
                'total' => 100000,
                'paymentAmount' => 100000,
                'change' => 0,
                'transaction_date' => now(),
            ],
            [
                'orderId' => 'ORD212',
                'total' => 120000,
                'paymentAmount' => 150000,
                'change' => 30000,
                'transaction_date' => now(),
            ],
            [
                'orderId' => 'ORD132',
                'total' => 45000,
                'paymentAmount' => 50000,
                'change' => 5000,
                'transaction_date' => now(),
            ],
        ]);
    }
}
