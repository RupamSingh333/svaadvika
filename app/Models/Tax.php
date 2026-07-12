<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use \App\Traits\Auditable;

    protected $fillable = [
        'name',
        'percentage',
        'description',
        'status',
    ];
}
