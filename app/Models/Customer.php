<?php

namespace App\Models;

use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, CanResetPassword;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'image',
        'phone',
        'is_active',
        'is_blocked',
        'email_verified_at',
    ];

    public function getNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_blocked' => 'boolean',
    ];

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function loginHistory()
    {
        return $this->hasMany(CustomerLoginHistory::class);
    }
}
