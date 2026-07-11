<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PermissionManager;

class CheckUserPermission
{
    protected $permissionManager;

    public function __construct(PermissionManager $permissionManager)
    {
        $this->permissionManager = $permissionManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        $routeName = $request->route()?->getName();
        
        // If route has no name or doesn't start with admin., let it pass (or you can block it)
        if (!$routeName || !str_starts_with($routeName, 'admin.')) {
            return $next($request);
        }

        $parts = explode('.', $routeName);
        if (count($parts) < 2) {
            return $next($request);
        }

        $moduleSlug = $parts[1];
        
        // Some core routes might not need permission checks like logout or profile edit
        $exemptModules = ['logout', 'profile'];
        if (in_array($moduleSlug, $exemptModules)) {
            return $next($request);
        }

        // Get action
        $actionRaw = isset($parts[2]) ? $parts[2] : 'view';
        
        // Map the route action to the permission action (e.g. store -> create)
        $actionSlug = $this->getRequiredActionForRoute($actionRaw);

        if (!$user->hasPermissionTo($moduleSlug, $actionSlug)) {
            abort(403, "You don't have permission to perform this action.");
        }

        return $next($request);
    }

    private function getRequiredActionForRoute($action)
    {
        $map = [
            'index'   => 'view',
            'show'    => 'view',
            'create'  => 'create',
            'store'   => 'create',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'delete',
            'export'  => 'export',
            'import'  => 'import',
        ];

        return $map[$action] ?? $action;
    }
    
    // Also we need to sync dynamically in a ServiceProvider or cron, but for now we can do it when visiting dashboard 
    // or let's create an Artisan command for it later.
}
