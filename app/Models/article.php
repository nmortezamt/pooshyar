<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','link','status','body','description','keyword','category_article_id','view','subcategory_article_id','img'];


    public function category()
    {
        return $this->belongsTo(categoryArticle::class,'category_article_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo(subcategoryArticle::class,'subcategory_article_id','id');
    }

}
