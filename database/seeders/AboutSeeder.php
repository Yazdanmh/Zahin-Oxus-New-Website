<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{

    public function run(): void
    {
        About::create([
            'title' => 'We Will Help You Manage Your Finances',
            'description' => 'At ZOCS, we are committed to helping you manage 
            your finances effectively and efficiently. Whether you are an individual looking to take control of your personal finances or a business owner seeking support with financial management, we have the expertise and experience to help you achieve your goals.',
            'features' => 'Business Competitive Analysis, Fast Growing Sells, Financing Project Investment',
        ]);
    }
}
