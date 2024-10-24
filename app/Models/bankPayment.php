<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class bankPayment extends Model
{
    use HasFactory;
    protected $fillable = ['ip','user_id','order_number','status','price','payment_id'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function payment()
    {
        return $this->belongsTo(payment::class , 'payment_id','id');
    }
}
