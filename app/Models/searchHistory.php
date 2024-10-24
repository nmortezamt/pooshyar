<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class searchHistory extends Model
{
    use HasFactory;
    protected $fillable = ['text_search','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }
}
