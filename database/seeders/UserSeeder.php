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
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@123'),
                'is_active' => true,
            ]
        );

        $actionIds = \App\Models\PermissionAction::pluck('id')->toArray();
        $inserts = [];
        foreach ($actionIds as $id) {
            $inserts[] = [
                'user_id' => $user->id,
                'permission_action_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        \App\Models\UserPermission::where('user_id', $user->id)->delete();
        if (count($inserts) > 0) {
            \App\Models\UserPermission::insert($inserts);
        }
    }
}
