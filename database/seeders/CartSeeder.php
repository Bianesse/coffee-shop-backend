<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::insert([
            ["coffeeId" => "2", "size" => "L", "amount" => "2"],
            ["coffeeId" => "1", "size" => "M", "amount" => "3"],
            ["coffeeId" => "3", "size" => "S", "amount" => "1"],
        ]);
    }
}
