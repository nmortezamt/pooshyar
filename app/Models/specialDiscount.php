<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['title','link','img','status'];
}
