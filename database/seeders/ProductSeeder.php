<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10000; $i++) {
            Product::create([
                'name' => $faker->word . ' ' . $faker->randomNumber(3),
                'price' => $faker->numberBetween(10000, 5000000),
                'description' => $faker->sentence(10),
            ]);
        }
    }
}
