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
            'our_vision' => 'To be a platform or an avenue to provide unrivalled services and to contribute to the growth of our client’s business and indirectly to the growth of Afghanistan’s financial system.', 
        ]);
    }
}
