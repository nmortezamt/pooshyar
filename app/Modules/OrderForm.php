<?php

use App\Models\cart;
use App\Models\order;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

    $userIp = Request::ip();
    if(auth()->user()){
        $order = order::get()->last();
        $carts = cart::where('user_id',auth()->user()->id)->where('status',0)->get();
        if($order)
        {
            foreach($carts as $cart){
                $orders = order::query()->create([
                    'product_id'=>$cart->product_id,
                    'user_id'=>auth()->user()->id,
                    'ip'=>$userIp,
                    'price'=>$cart->total_price,
                    'product_price'=>$cart->product_price_discount ? $cart->product_price_discount : $cart->product_price,
                    'count'=>$cart->count,
                    'order_count'=>$order->order_count +1,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'type'=>$cart->type,
                ]);
            }

        }else{
            $number = 111111111;
            foreach($carts as $cart){
                $orders = order::query()->create([
                    'product_id'=>$cart->product_id,
                    'user_id'=>auth()->user()->id,
                    'ip'=>$userIp,
                    'price'=>$cart->total_price,
                    'product_price'=>$cart->product_price_discount ? $cart->product_price_discount : $cart->product_price,
                    'count'=>$cart->count,
                    'order_count'=>$number,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'type'=>$cart->type,

                ]);


            }
        }


    }else{
        Session::put('url','/cart');
        alert()->warning('غیر مجاز', 'برای ادامه پرداخت و خرید، وارد حساب کاربری خود شوید')->showConfirmButton('باشه', '#3085d6');
        return redirect()->route('login.register.index');
        // $carts = cart::where('ip',$userIp)->where('status',0)->get();
        // $order = order::get()->last();
        // if($order)
        // {

        //     foreach($carts as $cart){
        //         $orders = order::query()->create([
        //             'product_id'=>$cart->product_id,
        //             'ip'=>$userIp,
        //             'price'=>$cart->total_price,
        //             'product_price'=>$cart->product_price_discount ? $cart->product_price_discount :$cart->product_price,
        //             'count'=>$cart->count,
        //             'order_count'=>$order->order_count +1,
        //             'color_id'=>$cart->color_id,
        //             'size_id'=>$cart->size_id,
        //             'type'=>$cart->type,

        //         ]);

        //     }
        // }else{
        //     $number = 111111111;
        //     foreach($carts as $cart){
        //         $orders = order::query()->create([
        //             'product_id'=>$cart->product_id,
        //             'ip'=>$userIp,
        //             'price'=>$cart->total_price,
        //             'product_price'=>$cart->product_price_discount ? $cart->product_price_discount :$cart->product_price,
        //             'count'=>$cart->count,
        //             'order_count'=>$number,
        //             'color_id'=>$cart->color_id,
        //             'size_id'=>$cart->size_id,
        //             'type'=>$cart->type,

        //         ]);

        //     }
        // }

    }

    return redirect()->route('order.index',$orders->order_count);


