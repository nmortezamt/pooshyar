<?php

namespace Modules\Product\Gallery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;

class Gallery extends Model
{
    protected $fillable = ['img','product_id','position'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
