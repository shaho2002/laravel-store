<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $fillable = [
        'name',
        'product_id',
        'category_feature_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function category_feature()
    {
        return $this->belongsTo(CategoryFeature::class);
    }
}
