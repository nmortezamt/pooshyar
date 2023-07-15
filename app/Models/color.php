<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class color extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['value','name','product_id'];

    public function product()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
}
