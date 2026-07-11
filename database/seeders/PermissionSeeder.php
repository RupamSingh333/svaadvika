<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use App\Models\PermissionAction;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'dashboard' => ['view'],
            'products' => ['view', 'create', 'edit', 'delete'],
            'categories' => ['view', 'create', 'edit', 'delete'],
            'orders' => ['view'],
            'coupons' => ['view', 'create', 'edit', 'delete'],
            'recipes' => ['view', 'create', 'edit', 'delete'],
            'users' => ['view', 'create', 'edit', 'delete'],
            'customers' => ['view', 'edit', 'delete'],
            'settings' => ['view'],
            'audit-logs' => ['view'],
            'contacts' => ['view', 'delete'],
        ];

        foreach ($modules as $moduleSlug => $actions) {
            $moduleName = ucwords(str_replace('-', ' ', $moduleSlug));
            
            $module = PermissionModule::firstOrCreate([
                'slug' => $moduleSlug,
            ], [
                'name' => $moduleName,
            ]);

            foreach ($actions as $actionSlug) {
                $actionName = ucfirst($actionSlug);
                
                PermissionAction::firstOrCreate([
                    'permission_module_id' => $module->id,
                    'slug' => $actionSlug,
                ], [
                    'name' => $actionName,
                ]);
            }
        }
    }
}
