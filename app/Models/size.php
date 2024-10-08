<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','name'];

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id','id');
    }


}
