<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
            'name',
            'slug',
            'image',
            'status',
            'parent_id'
        ];
    public function parentCategory()
    {
        return $this->belongsTo(self::class,'parent_id', 'id')->withDefault(['nameCategory' =>'دسته بندی اصلی']);
    }
    public function childCategory()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $childCategories = $category->childCategory()->withTrashed()->get();
            foreach ($childCategories as $child) {
                $child->delete();
            }
        });

        static::restoring(function ($category) {
            $childCategories = $category->childCategory()->withTrashed()->get();
            foreach ($childCategories as $child) {
                $child->restore();
            }
        });
    }
    public function category_features()
    {
        return $this->hasMany(CategoryFeature::class);
    }
}
