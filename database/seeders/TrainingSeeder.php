<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TrainingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 6; $i++) {
            DB::table('trainings')->insert([
                'name' => $faker->word,
                'image' => $faker->imageUrl(400, 300, 'business'),
                'description' => $faker->paragraph(3),
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'has_form' => $faker->boolean(),
                'slug' => $faker->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
