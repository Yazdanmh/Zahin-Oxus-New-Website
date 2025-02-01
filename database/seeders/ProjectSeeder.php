<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 6; $i++) {
            DB::table('projects')->insert([
                'name' => $faker->word,
                'description' => $faker->paragraph(3),
                'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
                'image' => $faker->imageUrl(400, 300, 'nature'),
                'slug' => $faker->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
