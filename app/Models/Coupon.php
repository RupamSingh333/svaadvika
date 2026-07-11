<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Coupon extends Model
{
    use Auditable;

    protected $fillable = [
        'code', 'type', 'value', 'min_cart_value', 'max_discount', 
        'expires_at', 'usage_limit', 'used_count', 'is_active'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
