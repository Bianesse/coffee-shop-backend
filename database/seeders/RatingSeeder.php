<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::insert([
            ["coffee_id" => "1", "user_id" => "2", "rating" => "4"],
            ["coffee_id" => "1", "user_id" => "2", "rating" => "5"],
            ["coffee_id" => "1", "user_id" => "2", "rating" => "5"],
            ["coffee_id" => "2", "user_id" => "2", "rating" => "3"],
            ["coffee_id" => "2", "user_id" => "2", "rating" => "5"],
            ["coffee_id" => "3", "user_id" => "3", "rating" => "4"],
            ["coffee_id" => "3", "user_id" => "3", "rating" => "3"],
            ["coffee_id" => "4", "user_id" => "3", "rating" => "5"],
        ]);
    }
}
