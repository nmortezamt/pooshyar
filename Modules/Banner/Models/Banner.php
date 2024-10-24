<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','img','description','slug','status'];

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE_STATUS);
    }
}
