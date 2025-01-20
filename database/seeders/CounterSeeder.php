<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Counter; 
class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Counter::create([
            'happy_users'=> 20, 
            'case_complete'=> 100, 
            'years_of_experience'=> 10, 
            'professional_advisor'=> 30,
        ]);
    }
}
