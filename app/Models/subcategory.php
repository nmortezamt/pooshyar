<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['img', 'title','parent','link','description'];

    public function category()
    {
        return $this->belongsTo(category::class,'parent','id');
    }
}
