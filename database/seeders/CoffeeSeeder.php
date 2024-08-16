<?php

namespace Database\Seeders;

use App\Models\Coffee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coffee::insert([
            ["name" => "Americano", "type" => "Espresso", "description" => "Made by adding hot water to a shot (or more) of espresso. This dilutes the coffee and gives it a similar strength and flavor profile to drip coffee, but with the richer taste and aroma of espresso. It’s a great option for those who want the robustness of espresso but with a lighter, more diluted taste.", "image" => "image/americano.jpg", "rate" => '0' ,"price"=> "25000"],
            ["name" => "Latte", "type" => "Espresso", "description" => "A smooth, creamy coffee drink made with one shot of espresso and steamed milk, usually topped with a small amount of milk foam. It has a mild coffee flavor due to the high milk-to-espresso ratio, making it a popular choice for those who enjoy a softer, creamier coffee experience.", "image" => "image/latte.jpg" , "rate" => '0' , "price"=> "30000"],
            ["name" => "Cappuccino", "type" => "Espresso", "description" => "Similar to a latte but with a different balance of ingredients. A cappuccino is made with one shot of espresso, steamed milk, and a thick layer of milk foam on top. Typically, the foam is about equal in volume to the espresso and steamed milk combined, giving it a rich, velvety texture with a stronger coffee flavor compared to a latte.", "image" => "image/cappuccino.jpg" , "rate" => '0' , "price"=> "35000"],
            ["name" => "Mochachino", "type" => "Espresso", "description" => "A delicious blend of espresso, steamed milk, and chocolate syrup or cocoa powder. It's similar to a cappuccino or latte but with a sweet, chocolatey twist. The drink often features a layer of milk foam on top, and sometimes it’s garnished with whipped cream and chocolate shavings. It offers a rich combination of coffee and chocolate flavors, making it a popular choice for those who enjoy a dessert-like coffee experience.", "image" => "image/mochaccino.jpg" ,"rate" => '0' , "price"=> "40000"],
        ]);
    }
}
