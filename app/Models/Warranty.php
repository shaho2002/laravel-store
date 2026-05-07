<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'code',
        'image',
        'description',
    ];
    public function ProductPrices()
    {
        return $this->belongsToMany(Warranty::class, 'warranties_products');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
