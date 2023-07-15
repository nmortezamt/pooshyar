<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentArticle extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','comment','user_id','status','article_id'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function article()
    {
        return $this->belongsTo(article::class , 'article_id','id');
    }
    public function answer()
    {
        return $this->hasOne(answerCommentArticle::class ,'comment_id','id');
    }
}
