<?php

namespace Modules\Product\Size\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Product\Models\product;

class Size extends Model
{
    protected $fillable = ['name'];
}