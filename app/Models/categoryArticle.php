<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryArticle extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['img', 'title','link','status','description'];

    public function subcategory()
    {
        return $this->hasMany(subcategoryArticle::class , 'category_article_id','id');
    }

        public function article()
    {
        return $this->hasOne(article::class ,'category_article_id','id');
    }
}
