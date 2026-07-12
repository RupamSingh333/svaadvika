<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverySetting extends Model
{
    use \App\Traits\Auditable;

    protected $fillable = [
        'delivery_type',
        'fixed_charge',
        'free_delivery_above',
        'minimum_order',
        'status',
    ];
}
