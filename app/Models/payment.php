<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['product_id','user_id','ip','discount_code','discount_price','total_price','count','transactionId','order_number','status','color_id','size_id','order_id','name','lname','address','address_two','state','city','postal_code','phone','email','info','discount_percent','driver','product_price','type'];

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
