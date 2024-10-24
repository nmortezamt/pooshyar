<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Product\Models\product;

class attributeValue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['product_id', 'attribute_id','value','status'];

    public function attribute()
    {
        return $this->belongsTo(attribute::class , 'attribute_id','id');
    }

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id','id');
    }
}
