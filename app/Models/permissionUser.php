<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissionUser extends Model
{
    use HasFactory;
    protected $fillable = ['permission_id','user_id'];
}
