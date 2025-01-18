<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'title' => 'Strengthen your Compliance',
            'subtitle' => 'Financial and Management Consulting',
            'description' => 'Welcome to Zahin Oxus, where expert financial advice meets personalized service. Our team of professionals is dedicated to helping you achieve your financial goals. Contact us now to learn more.',
            'button' => 'Get Started',
            'link' => '#',
        ]);
    }
}
