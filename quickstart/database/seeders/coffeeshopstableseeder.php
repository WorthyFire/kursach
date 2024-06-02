<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeeshopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coffeeshops')->insert([
            [
                'name' => 'Coffibee Москва',
                'description' => 'Популярная кофейня в центре Москвы, предлагающая широкий выбор кофе и десертов.',
                'address' => 'Москва, ул. Тверская, 12',
                'contact' => '+7 (495) 123-45-67',
                'photo' => 'https://example.com/moscow.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffibee Санкт-Петербург',
                'description' => 'Уютная кофейня в историческом центре Санкт-Петербурга.',
                'address' => 'Санкт-Петербург, Невский проспект, 45',
                'contact' => '+7 (812) 987-65-43',
                'photo' => 'https://example.com/spb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffibee Казань',
                'description' => 'Современная кофейня с уникальными напитками и уютной атмосферой.',
                'address' => 'Казань, ул. Баумана, 50',
                'contact' => '+7 (843) 456-78-90',
                'photo' => 'https://example.com/kazan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffibee Новосибирск',
                'description' => 'Кофейня в центре Новосибирска, известная своими авторскими напитками.',
                'address' => 'Новосибирск, Красный проспект, 30',
                'contact' => '+7 (383) 234-56-78',
                'photo' => 'https://example.com/novosibirsk.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffibee Екатеринбург',
                'description' => 'Популярная кофейня с дружелюбной атмосферой и отличным кофе.',
                'address' => 'Екатеринбург, ул. Ленина, 18',
                'contact' => '+7 (343) 678-90-12',
                'photo' => 'https://example.com/ekb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
