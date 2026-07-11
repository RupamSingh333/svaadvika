<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Biryani Kits', 'slug' => 'biryani-kits', 'description' => 'Authentic ready-to-cook biryani kits', 'is_active' => true],
            ['name' => 'Marinades', 'slug' => 'marinades', 'description' => 'Premium spices and marinades', 'is_active' => true],
            ['name' => 'Combos', 'slug' => 'combos', 'description' => 'Special family combo packs', 'is_active' => true],
            ['name' => 'Spices', 'slug' => 'spices', 'description' => 'Authentic regional spices', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
