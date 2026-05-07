<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = [
        'name',
        'e_name',
        'main_price',
        'price',
        'discount',
        'count',
        'max_sell',
        'sold',
        'status',
        'product_id',
        'color_id',
        'warranty_id',
    ];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
