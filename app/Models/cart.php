<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Color\Models\color;
use Modules\Product\Product\Models\product;
use Modules\Product\Size\Models\size;
use Modules\User\Models\User;

class cart extends Model
{
    use HasFactory;
    protected $fillable=['product_id', 'user_id','ip','product_price','product_price_discount','count','color_id','size_id','timezone','areaCode','metroCode','longitude','latitude','postalCode','isoCode','zipCode','cityName','regionName','regionCode','countryCode','total_price','status','type'];

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
