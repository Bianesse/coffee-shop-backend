<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CoffeeSeeder::class,
            PriceSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            TransactionSeeder::class,
            TransactionItemSeeder::class,
            RatingSeeder::class,
        ]);
    }
}
