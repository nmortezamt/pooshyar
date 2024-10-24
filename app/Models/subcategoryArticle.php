<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Blog\Models\blog;

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
        return $this->hasOne(blog::class,'subcategory_article_id','id');
    }
}
