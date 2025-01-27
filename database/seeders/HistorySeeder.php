<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\History;
class HistorySeeder extends Seeder
{
   
    public function run(): void
    {
        History::create([
            'title' => 'We Do Consultancy For Developing A New Business Culture Company', 
            'subtitle' => 'Behind Our History', 
            'progress_items' => '{"Software":78,"Consulting":80,"Finance":20}',
            'description' => 'Transform your business with our transforeive consulting solution We go beyond short-term fixes to deliver sustainable growth strategies that future-proof your enterprise.',
        ]);
    }
}
