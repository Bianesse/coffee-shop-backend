<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CartItem::insert([
            [
                'user_id' => '2',
                'coffeeId' => 1,
                'size' => 'S',
                'quantity' => 2,
                'subtotal' => 20000,
            ],
            [
                'user_id' => '2',
                'coffeeId' => 2,
                'size' => 'M',
                'quantity' => 4,
                'subtotal' => 60000,
            ],
            [
                'user_id' => '2',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
                'subtotal' => 24000,
            ],
            [
                'user_id' => '5',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
                'subtotal' => 24000,
            ],
            [
                'user_id' => '5',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
                'subtotal' => 24000,
            ],
        ]);
    }
}
