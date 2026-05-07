<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFeature extends Model
{
    protected $fillable = [
        'name',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product_infos()
    {
        return $this->hasMany(ProductInfo::class);
    }
}
