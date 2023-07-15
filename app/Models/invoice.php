<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = ['name_product','color_product','size_product','count_product','price_product','order_number','name_customer','family_customer','phone_customer','email_customer','user_id_customer','discount_code','total_price','transactionId','payment_id','discount_percent','discount_price','type'];
}
