<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Color\Models\color;
use Modules\Product\Product\Models\product;
use Modules\Product\Size\Models\size;
use Modules\User\Models\User;

class order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['product_id','user_id','ip','discount_code','discount_price','price','count','transactionId','order_count','payment','color_id','size_id','discount_percent','product_price','type'];

    public function product()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }
    public function color()
    {
        return $this->belongsTo(color::class,'color_id','id');
    }

    public function size()
    {
        return $this->belongsTo(size::class,'size_id','id');
    }

}
