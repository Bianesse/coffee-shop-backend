<?php

namespace Database\Seeders;

use App\Models\TransactionItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionItem::insert([
            [
                'orderId' => 'ORD232',
                'coffeeId' => 1,
                'quantity' => 2,
            ],
            [
                'orderId' => 'ORD212',
                'coffeeId' => 2,
                'quantity' => 1,
            ],
            [
                'orderId' => 'ORD212',
                'coffeeId' => 1,
                'quantity' => 1,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 1,
                'quantity' => 2,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 3,
                'quantity' => 2,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 1,
                'quantity' => 3,
            ],
        ]);
    }
}
