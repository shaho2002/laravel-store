<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'article_category_id',
        'title',
        'slug',
        'image',
        'article',
        'status',
    ];
    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
