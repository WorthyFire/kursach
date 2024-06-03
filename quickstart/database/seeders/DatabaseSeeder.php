<?php

namespace Database\Seeders;

use App\Models\Drink;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Вызов нового сидера
        $this->call([
            coffeeshopstableseeder::class,
            DrinksTableSeeder::class,
            rolestableSeeder::class,
            userstableseeder::class,
        ]);
    }
}
