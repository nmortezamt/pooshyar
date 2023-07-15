<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndSeasonDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['link','img','status'];

}
