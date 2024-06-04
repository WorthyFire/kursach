<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DrinksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drinks')->insert([
            // Напитки для кофейни с ID 8
            [
                'name' => 'Латте',
                'ingredients' => 'Молоко, Кофе',
                'category' => 'Горячие напитки',
                'photo' => 'latte.jpg',
                'description' => 'Вкусный латте',
                'coffeeshop_id' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Маккиато',
                'ingredients' => 'Кофе, Молоко',
                'category' => 'Горячие напитки',
                'photo' => 'macchiato.jpg',
                'description' => 'Кофе маккиато с молоком',
                'coffeeshop_id' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Фраппе',
                'ingredients' => 'Кофе, Лед, Молоко',
                'category' => 'Холодные напитки',
                'photo' => 'frappe.jpg',
                'description' => 'Освежающий фраппе',
                'coffeeshop_id' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Напитки для кофейни с ID 10
            [
                'name' => 'Капучино',
                'ingredients' => 'Молоко, Кофе',
                'category' => 'Горячие напитки',
                'photo' => 'cappuccino.jpg',
                'description' => 'Классический капучино',
                'coffeeshop_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Американо',
                'ingredients' => 'Кофе, Вода',
                'category' => 'Горячие напитки',
                'photo' => 'americano.jpg',
                'description' => 'Классический американо',
                'coffeeshop_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Эспрессо',
                'ingredients' => 'Кофе',
                'category' => 'Горячие напитки',
                'photo' => 'espresso.jpg',
                'description' => 'Крепкий эспрессо',
                'coffeeshop_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Напитки для кофейни с ID 12
            [
                'name' => 'Гляссе',
                'ingredients' => 'Кофе, Мороженое',
                'category' => 'Холодные напитки',
                'photo' => 'glace.jpg',
                'description' => 'Кофе с мороженым',
                'coffeeshop_id' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Мокко',
                'ingredients' => 'Кофе, Шоколад, Молоко',
                'category' => 'Горячие напитки',
                'photo' => 'mocha.jpg',
                'description' => 'Шоколадный мокко',
                'coffeeshop_id' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Флэт Уайт',
                'ingredients' => 'Кофе, Молоко',
                'category' => 'Горячие напитки',
                'photo' => 'flat_white.jpg',
                'description' => 'Нежный флэт уайт',
                'coffeeshop_id' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
