<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable=['img', 'title','link','status','view','description'];

    public function subcategory()
    {
        return $this->hasMany(subcategory::class , 'parent','id');
    }

    public function product()
    {
        return $this->hasMany(product::class , 'category_id','id');
    }
}
