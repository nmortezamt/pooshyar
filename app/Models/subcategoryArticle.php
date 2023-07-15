<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subcategoryArticle extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['img', 'title','category_article_id','link','description'];

    public function category()
    {
        return $this->belongsTo(categoryArticle::class,'category_article_id','id');
    }

    public function article()
    {
        return $this->hasOne(article::class,'subcategory_article_id','id');
    }
}
