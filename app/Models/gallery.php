<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    protected $table ='gallerys';
    protected $fillable=['img','product_id','position'];

    public function product()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }

}
