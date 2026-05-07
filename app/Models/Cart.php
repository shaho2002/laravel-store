<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'warranty_id',
        'count'
    ];
    public function user()
    {
        return $this->BelongsTo(User::class,'user_id');
    }
    public function product()
    {
        return $this->BelongsTo(Product::class,'product_id');
    }
}
