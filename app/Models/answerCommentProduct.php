<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;

class answerCommentProduct extends Model
{
    use HasFactory;
    protected $fillable =['product_id','comment_id','body'];

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id','id');
    }

    public function comment()
    {
        return $this->belongsTo(commentProduct::class,'comment_id','id');
    }
}
