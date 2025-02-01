<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['title' => 'Web Development'],
            ['title' => 'Mobile Development'],
            ['title' => 'Design'],
            ['title' => 'Marketing'],
        ]);
    }
}
