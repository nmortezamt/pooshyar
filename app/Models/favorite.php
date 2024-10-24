<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;
use Modules\User\Models\User;

class favorite extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','user_id'];
    public function product()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }
}
