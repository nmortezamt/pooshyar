<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;

class Category extends Model
{
    protected $fillable = ['title','slug','status','view','description','parent_id', 'type','img'];

    public function subcategories()
    {
        return $this->hasMany(Category::class , 'parent_id','id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class , 'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany(product::class , 'category_id','id')->where('type',self::PRODUCT_TYPE);
    }

    public function scopeGetBlogTypeCategories($query)
    {
        return $query->where('type', self::BLOG_TYPE)->whereNull('parent_id');
    }

    public function scopeGetProductTypeCategories($query)
    {
        return $query->where('type', self::PRODUCT_TYPE)->whereNull('parent_id');
    }

    public function scopeGetProductTypeSubCategories($query, $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }

    public function scopeGetBlogTypeSubCategories($query, $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }
    public function scopeGetParentCategoriesExcludingCurrent($query, $id, $type)
    {
        return $query->whereNull('parent_id')->where('id','!=',$id)->where('type', $type);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE_STATUS);
    }

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    const PRODUCT_TYPE = 'product';
    const BLOG_TYPE = 'blog';

    public static $types = [
        self::PRODUCT_TYPE,
        self::BLOG_TYPE
    ];
}
