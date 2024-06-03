<?php

namespace Database\Seeders;

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
            CoffeeshopsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            DrinksTableSeeder::class,

        ]);
    }
}
