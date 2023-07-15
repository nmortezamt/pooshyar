<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productView extends Model
{
    use HasFactory;
    protected $fillable = ['ip','product_id'];
}
