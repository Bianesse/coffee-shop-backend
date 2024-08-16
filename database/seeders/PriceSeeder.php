<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Price::insert([
            ["coffee_id" => '1', 'size' => 'S', 'price' => '10000'],
            ["coffee_id" => '1', 'size' => 'M', 'price' => '12000'],
            ["coffee_id" => '1', 'size' => 'L', 'price' => '14000'],
            ["coffee_id" => '2', 'size' => 'S', 'price' => '14000'],
            ["coffee_id" => '2', 'size' => 'M', 'price' => '15000'],
            ["coffee_id" => '2', 'size' => 'L', 'price' => '17000'],
            ["coffee_id" => '3', 'size' => 'S', 'price' => '20000'],
            ["coffee_id" => '3', 'size' => 'M', 'price' => '22000'],
            ["coffee_id" => '3', 'size' => 'L', 'price' => '24000'],
            ["coffee_id" => '4', 'size' => 'S', 'price' => '25000'],
            ["coffee_id" => '4', 'size' => 'M', 'price' => '27000'],
            ["coffee_id" => '4', 'size' => 'L', 'price' => '30000'],
        ]);
    }
}
