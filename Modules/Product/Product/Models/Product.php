<?php

namespace Modules\Product\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\category;
use Modules\Product\Brand\Models\brand;
use Modules\Product\Color\Models\color;
use Modules\Product\Gallery\Models\gallery;
use Modules\Product\Size\Models\size;


class Product extends Model
{
    protected $fillable = [
        'img',
        'title',
        'slug',
        'category_id',
        'subcategory_id',
        'body',
        'price',
        'price_major',
        'discount_price',
        'description',
        'quantity',
        'is_published',
        'view',
        'status',
        'brand_id',
        'order_count',
        'description_seo'
    ];


    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class,'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class,'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'product_colors', 'product_id','color_id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class,'product_sizes','product_id','size_id');
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price);
    }

    public function getFormattedPriceMajorAttribute()
    {
        return number_format($this->price_major);
    }

    public function getFormattedDiscountPriceAttribute()
    {
        return number_format($this->discount_price);
    }
}
