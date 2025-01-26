<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OurMission;
class OurMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurMission::create([
            'our_mission' => 'Empowering clients to increase access and usage of quality services for their customers through knowledge sharing, expertise, and experience of professionals with utmost commitment, care, integrity, trust, and teamwork.',
        ]);
    }
}
