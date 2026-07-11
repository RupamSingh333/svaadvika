<?php

namespace App\Traits;

use App\Models\PermissionAction;
use App\Models\UserPermission;

trait HasCustomPermissions
{
    public function permissions()
    {
        return $this->hasMany(UserPermission::class);
    }

    public function permissionActions()
    {
        return $this->belongsToMany(PermissionAction::class, 'user_permissions');
    }

    public function hasPermissionTo($moduleSlug, $actionSlug)
    {
        // For super admins (if you want to implement this later, e.g., user ID 1)
        if ($this->id === 1) {
            return true;
        }

        return $this->permissionActions()
            ->whereHas('module', function ($query) use ($moduleSlug) {
                $query->where('slug', $moduleSlug);
            })
            ->where('slug', $actionSlug)
            ->exists();
    }
}
