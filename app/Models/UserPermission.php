<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = [
        'user_id',
        'permission_action_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permissionAction()
    {
        return $this->belongsTo(PermissionAction::class);
    }
}
