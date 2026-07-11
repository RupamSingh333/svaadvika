<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function actions()
    {
        return $this->hasMany(PermissionAction::class);
    }
}
