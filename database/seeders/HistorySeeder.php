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
            'title' => 'Transforming Businesses with Expertise and Innovation', 
            'subtitle' => 'Why Choose Zahin Oxus?', 
            'progress_items' => '{"FinancialAdvisory":85,"BusinessDevelopment":70,"TrainingPrograms":60}',
            'description' => 'Zahin Oxus delivers tailored solutions with over 10 years of expertise in financial advisory, business development, and compliance. We combine industry knowledge and technology to provide strategic consulting and measurable results for business growth.',
        ]);
    }
}
