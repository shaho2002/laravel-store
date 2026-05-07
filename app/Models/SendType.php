<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendType extends Model
{
    protected $fillable = [
        'name',
        'cost',
        'status',
    ];
}
