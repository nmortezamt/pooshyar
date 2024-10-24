<?php

namespace Modules\Blog\Models;

use App\Models\categoryArticle;
use App\Models\subcategoryArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Category;

class Blog extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'status',
        'body',
        'description',
        'description_seo',
        'category_id',
        'subcategory_id',
        'view',
        'img'
    ];

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class,'subcategory_id');
    }

}
