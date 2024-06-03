<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drinks')->insert([
            [
                'name' => 'Latte',
                'ingredients' => 'Milk, Coffee',
                'category' => 'Hot Drinks',
                'photo' => 'latte.jpg',
                'description' => 'A delicious latte',
                'coffeeshop_id' => 8, // ID кофейни из базы данных
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cappuccino',
                'ingredients' => 'Milk, Coffee',
                'category' => 'Hot Drinks',
                'photo' => 'cappuccino.jpg',
                'description' => 'A classic cappuccino',
                'coffeeshop_id' => 9, // ID кофейни из базы данных
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Espresso',
                'ingredients' => 'Coffee',
                'category' => 'Hot Drinks',
                'photo' => 'espresso.jpg',
                'description' => 'A strong espresso',
                'coffeeshop_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
