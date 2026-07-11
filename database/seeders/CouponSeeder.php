<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Coupon::create([
            'code' => 'WELCOME50',
            'type' => 'fixed',
            'value' => 50.00,
            'min_cart_value' => 300.00,
            'is_active' => true,
        ]);

        \App\Models\Coupon::create([
            'code' => 'SUMMER10',
            'type' => 'percentage',
            'value' => 10.00,
            'max_discount' => 100.00,
            'min_cart_value' => 500.00,
            'is_active' => true,
        ]);
    }
}
