<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;
use Modules\User\Models\User;

class commentProduct extends Model
{
    use HasFactory;
    protected $fillable = ['comment','user_id','status','product_id','rate'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id','id');
    }
    public function answer()
    {
        return $this->hasOne(answerCommentProduct::class ,'comment_id','id');
    }
}
