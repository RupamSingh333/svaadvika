<?php

namespace App\Services;

use App\Models\PermissionModule;
use App\Models\PermissionAction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PermissionManager
{
    /**
     * Automatically discover and sync modules and actions from routes.
     * Route names must follow convention: admin.module.action
     * e.g., admin.products.index -> Module: Product, Action: View
     */
    public function syncDynamicPermissions()
    {
        $routes = Route::getRoutes()->getRoutes();
        $adminRoutes = [];

        foreach ($routes as $route) {
            $name = $route->getName();
            // Only process routes starting with admin.
            if ($name && str_starts_with($name, 'admin.')) {
                $adminRoutes[] = $name;
            }
        }

        $modules = [];
        
        foreach ($adminRoutes as $routeName) {
            $parts = explode('.', $routeName);
            if (count($parts) < 2) continue;
            
            // Format: admin.{module}.{action} OR admin.{module}
            $moduleSlug = $parts[1];
            $actionRaw = isset($parts[2]) ? $parts[2] : 'view'; // Default action is view for top-level routes like admin.dashboard
            
            // Map common route actions to standard permission actions
            $actionSlug = $this->mapRouteActionToPermission($actionRaw);
            if (!$actionSlug) continue; // Skip ignored actions like 'store' (covered by 'create') or 'update' (covered by 'edit')
            
            $moduleName = Str::title(str_replace('-', ' ', $moduleSlug));
            $actionName = Str::title(str_replace('-', ' ', $actionSlug));
            
            if (!isset($modules[$moduleSlug])) {
                $modules[$moduleSlug] = [
                    'name' => $moduleName,
                    'actions' => []
                ];
            }
            
            $modules[$moduleSlug]['actions'][$actionSlug] = $actionName;
        }

        // Sync to database
        foreach ($modules as $modSlug => $modData) {
            $module = PermissionModule::firstOrCreate(
                ['slug' => $modSlug],
                ['name' => $modData['name']]
            );

            foreach ($modData['actions'] as $actSlug => $actName) {
                PermissionAction::firstOrCreate(
                    ['permission_module_id' => $module->id, 'slug' => $actSlug],
                    ['name' => $actName]
                );
            }
        }
    }

    private function mapRouteActionToPermission($action)
    {
        $map = [
            'index'   => 'view',
            'show'    => 'view',
            'create'  => 'create',
            'store'   => false, // Ignored, handled by create
            'edit'    => 'edit',
            'update'  => false, // Ignored, handled by edit
            'destroy' => 'delete',
            'export'  => 'export',
            'import'  => 'import',
        ];

        if (isset($map[$action])) {
            return $map[$action];
        }
        
        // Custom actions just pass through
        return $action;
    }
}
