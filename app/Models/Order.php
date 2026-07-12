<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Order extends Model
{
    use Auditable;

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'tax_amount',
        'delivery_charge',
        'discount_amount',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'shipping_address',
        'billing_address',
    ];
}
