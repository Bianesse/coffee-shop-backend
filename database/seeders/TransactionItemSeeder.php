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
                'coffeeId' => 2,
                'size' => 'M',
                'quantity' => 4,
                'subtotal' => 60000,
            ],
            [
                'orderId' => 'ORD212',
                'coffeeId' => 2,
                'size' => 'M',
                'quantity' => 4,
                'subtotal' => 60000,
            ],
            [
                'orderId' => 'ORD212',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
                'subtotal' => 24000,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
                'subtotal' => 24000,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 1,
                'size' => 'S',
                'quantity' => 2,
                'subtotal' => 20000,
            ],
            [
                'orderId' => 'ORD132',
                'coffeeId' => 1,
                'size' => 'S',
                'quantity' => 2,
                'subtotal' => 20000,
            ],
        ]);
    }
}
