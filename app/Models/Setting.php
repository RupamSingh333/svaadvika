<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Setting extends Model
{
    use Auditable;

    protected $fillable = ['key', 'value', 'group'];
}
