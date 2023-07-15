<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class product extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $fillable=['img', 'title','link','status','category_id','subcategory_id','body','price','price_major','description','discount_price','number','status','view','php artisan ser
    ','shipment','time','brand_id','order_count','description_seo'];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'link' => [
                'source' => 'title'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(category::class,'category_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(subcategory::class,'subcategory_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(brand::class,'brand_id','id');
    }

    public function gallery()
    {
        return $this->belongsTo(gallery::class,'product_id','id');
    }

    public function color()
    {
        return $this->belongsTo(color::class,'product_id','id');
    }

    public function size()
    {
        return $this->belongsTo(size::class,'product_id','id');
    }
}
