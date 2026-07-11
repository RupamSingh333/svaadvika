<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'customers.view', 'customers.create', 'customers.edit', 'customers.delete',
            'categories.view', 'categories.create', 'categories.edit', 'categories.delete',
            'subcategories.view', 'subcategories.create', 'subcategories.edit', 'subcategories.delete',
            'products.view', 'products.create', 'products.edit', 'products.delete',
            'orders.view', 'orders.update', 'orders.cancel', 'orders.export',
            'payments.view', 'payments.refund',
            'coupons.view', 'coupons.create', 'coupons.edit', 'coupons.delete',
            'blogs.view', 'blogs.create', 'blogs.edit', 'blogs.delete',
            'contacts.view', 'contacts.reply', 'contacts.delete',
            'sliders.view', 'sliders.create', 'sliders.edit', 'sliders.delete',
            'settings.view', 'settings.update',
            'reports.view', 'reports.export',
            'activitylogs.view',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign created permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        // Super Admin gets all permissions via a Gate rule usually, but we can assign all here
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $staff = Role::firstOrCreate(['name' => 'Staff']);

        // Create default super admin user
        $user = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('Admin@123'),
        ]);

        $user->assignRole($superAdmin);
    }
}
