<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Mista', 'email' => 'mista@gmail.com', 'password' => Hash::make('mista123'), 'role' => '1'],
            ['name' => 'Jon', 'email' => 'jon@gmail.com', 'password' => Hash::make('jon123'), 'role' => '2'],
            ['name' => 'Kai', 'email' => 'kai@gmail.com', 'password' => Hash::make('kai123'), 'role' => '3'],
        ]);
    }
}
