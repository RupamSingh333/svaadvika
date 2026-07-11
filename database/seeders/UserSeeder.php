<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if admin user already exists
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('Admin@123'),
                'is_active' => true,
            ]);
        }
    }
}
