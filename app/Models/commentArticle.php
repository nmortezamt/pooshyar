<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\blog;
use Modules\User\Models\User;

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
        return $this->belongsTo(blog::class , 'article_id','id');
    }
    public function answer()
    {
        return $this->hasOne(answerCommentArticle::class ,'comment_id','id');
    }
}
