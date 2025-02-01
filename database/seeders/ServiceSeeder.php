<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $icons = [
            'bx bx-home',
            'bx bx-cog',
            'bx bx-briefcase',
            'bx bx-phone',
            'bx bx-heart',
            'bx bx-world',
        ];

        for ($i = 0; $i < 6; $i++) {
            DB::table('services')->insert([
                'title' => $faker->words(3, true),
                'subtitle' => $faker->sentence,
                'image' => $faker->imageUrl(400, 300, 'business'),
                'icon' => $icons[array_rand($icons)],
                'description' => $faker->paragraph(3),
                'slug' => $faker->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
