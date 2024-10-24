<?php

namespace Modules\Product\Color\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Product\Models\product;

class Color extends Model
{
    protected $fillable = ['value','name'];
}
