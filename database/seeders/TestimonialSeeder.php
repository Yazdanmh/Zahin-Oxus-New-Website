<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 6; $i++) {
            DB::table('testimonials')->insert([
                'name' => $faker->name,
                'position' => $faker->jobTitle,
                'stars' => $faker->numberBetween(1, 5),
                'message' => $faker->paragraph(3),
                'image' => $faker->imageUrl(400, 400, 'people'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
