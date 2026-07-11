<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = \App\Models\Category::where('slug', 'biryani-kits')->first();

        if ($category) {
            \App\Models\Product::create([
                'category_id' => $category->id,
                'name' => 'Hyderabadi Chicken Biryani Kit',
                'slug' => 'hyderabadi-chicken-biryani-kit',
                'sku' => 'BKN-HYD-CHK-01',
                'short_description' => 'Authentic Hyderabadi dum biryani kit with premium basmati rice and signature spices.',
                'long_description' => 'Experience the royal taste of Hyderabad with our easy-to-cook biryani kit. Contains finest quality basmati rice, our secret spice mix, and marination paste. Just add chicken and cook!',
                'price' => 399.00,
                'sale_price' => 349.00,
                'stock_quantity' => 100,
                'is_featured' => true,
                'status' => 'active'
            ]);
            
            \App\Models\Product::create([
                'category_id' => $category->id,
                'name' => 'Lucknowi Mutton Biryani Kit',
                'slug' => 'lucknowi-mutton-biryani-kit',
                'sku' => 'BKN-LUK-MUT-02',
                'short_description' => 'Awadhi style fragrant mutton biryani kit.',
                'long_description' => 'Delicate flavors of Awadh brought to your kitchen. A perfect blend of mild spices and kewra water.',
                'price' => 499.00,
                'sale_price' => 449.00,
                'stock_quantity' => 50,
                'is_featured' => true,
                'status' => 'active'
            ]);
        }
    }
}
