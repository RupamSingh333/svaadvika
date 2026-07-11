<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLoginHistory extends Model
{
    public $timestamps = false;
    protected $table = 'customer_login_history';

    protected $fillable = [
        'customer_id',
        'ip_address',
        'user_agent',
        'login_at',
    ];

    protected $casts = [
        'login_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
