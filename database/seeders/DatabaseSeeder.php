<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            UserSeeder::class, 
            SettingsSeeder::class,
            HeroSeeder::class,
            ServiceSeeder::class,
            CategorySeeder::class, 
            ProjectSeeder::class, 
            TestimonialSeeder::class, 
            TrainingSeeder::class, 
            CounterSeeder::class,
            AboutSeeder::class,
            OurMissionSeeder::class,
            OurVisionSeeder::class,
            HistorySeeder::class,
            NewsSeeder::class, 
        ]);
    }
}
