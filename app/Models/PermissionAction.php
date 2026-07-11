<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionAction extends Model
{
    protected $fillable = [
        'permission_module_id',
        'name',
        'slug',
    ];

    public function module()
    {
        return $this->belongsTo(PermissionModule::class, 'permission_module_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }
}
