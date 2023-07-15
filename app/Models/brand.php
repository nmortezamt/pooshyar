<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['img', 'description','category_id','link','name','status'];

    public function category()
    {
        return $this->belongsTo(category::class,'category_id','id');
    }
}
