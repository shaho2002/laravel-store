<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'code',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class,'colors_products');
    }
     public function ProductPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
