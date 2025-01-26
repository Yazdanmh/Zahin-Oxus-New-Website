<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OurVision; 
class OurVisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurVision::create([
            'our_vision' => 'Empowering clients to increase access and usage of quality services for their customers through knowledge sharing, expertise, and experience of professionals with utmost commitment, care, integrity, trust, and teamwork.', 
        ]);
    }
}
