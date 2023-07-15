<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_card extends Model
{
    use HasFactory;
    protected $fillable = ['page_id'];
    public function page()
    {
        return $this->belongsTo(page::class,'page_id','id');
    }
}
