<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\blog;

class answerCommentArticle extends Model
{
    use HasFactory;
    protected $fillable =['article_id','comment_id','body'];

    public function article()
    {
        return $this->belongsTo(blog::class , 'article_id','id');
    }

    public function comment()
    {
        return $this->belongsTo(commentArticle::class,'comment_id','id');
    }


}
