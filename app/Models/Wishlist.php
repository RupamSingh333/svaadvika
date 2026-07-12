<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'customer_id',
        'session_id',
    ];

    public function items()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
