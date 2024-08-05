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
                'cartId' => 'CART01',
                'coffeeId' => 1,
                'size' => 'S',
                'quantity' => 2,
            ],
            [
                'cartId' => 'CART01',
                'coffeeId' => 2,
                'size' => 'M',
                'quantity' => 4,
            ],
            [
                'cartId' => 'CART01',
                'coffeeId' => 3,
                'size' => 'L',
                'quantity' => 1,
            ],
        ]);
    }
}
