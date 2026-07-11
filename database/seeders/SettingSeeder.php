<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Svaadvika', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Premium Indian Ready-to-Cook Food', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@svaadvika.com', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+91 99999 99999', 'group' => 'general'],
            ['key' => 'address', 'value' => 'New Delhi, India', 'group' => 'general'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/svaadvika', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/svaadvika', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/svaadvika', 'group' => 'social'],
            ['key' => 'currency_symbol', 'value' => '₹', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
