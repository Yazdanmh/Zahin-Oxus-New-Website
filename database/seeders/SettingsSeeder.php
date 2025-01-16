<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'site_name' => 'My Website',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.ico',
            'email' => 'info@zahin-oxus.af',
            'phone' => '+93 783226633',
            'address' => 'Kabul, Afghanistan',
            'about' => 'Welcome to Zahin Oxus, where expert financial advice meets personalized service. Our team of professionals is dedicated to helping you achieve your financial goals. Contact us now to learn more.',
            'facebook_url' => 'https://www.facebook.com/ZahinOxus',
            'twitter_url' => 'https://twitter.com/mywebsite',
            'instagram_url' => 'https://instagram.com/mywebsite',
            'linkedin_url' => 'https://linkedin.com/company/mywebsite',
            'youtube_url' => 'https://youtube.com/mywebsite',
            'maintenance_mode' => false,
        ]);
    }
}
