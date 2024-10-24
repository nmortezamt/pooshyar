<?php

namespace Modules\Product\Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Category;
use Modules\Product\Product\Models\Product;

class Brand extends Model
{

    protected $fillable = ['img', 'description','slug','name','status'];

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
