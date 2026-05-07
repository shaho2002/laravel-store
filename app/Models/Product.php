<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Laravel\Prompts\table;

class Product extends Model
{ 
    use SoftDeletes;
    protected $fillable = [
        'name',
        'e_name',
        'slug',
        'price',
        'discount',
        'count',
        'max_sell',
        'viewed',
        'sold',
        'image',
        'description',
        'status',
        'category_id',
        'brand_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function warranties()
    {
        return $this->belongsToMany(Warranty::class,'warranties_products');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class,'colors_products');
    }
    public function ProductPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }
    public function product_infos()
    {
        return $this->hasMany(ProductInfo::class);
    }
    public function ProductGallery()
    {
        return $this->hasMany(ProductGallery::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favorite_products_user()
    {
        return $this->belongsToMany(User::class,'favorite_users_products');
    }
    
}
