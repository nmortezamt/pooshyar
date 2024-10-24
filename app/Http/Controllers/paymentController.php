<?php

namespace App\Http\Controllers;

use App\Models\bankPayment;
use App\Models\cart;
use App\Models\invoice as ModelsInvoice;
use App\Models\order;
use App\Models\payment as ModelsPayment;
use Modules\Product\Product\Models\product;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;

class paymentController extends Controller
{
    public function payment()
    {
        $paymentBank = bankPayment::where('user_id',auth()->user()->id)->where('status',0)->orderBy('created_at', 'desc')->first();
        if($paymentBank->status == 1){
            alert()->warning('خطا', 'شما قبلا این سفارش را پرداخت کرده اید')->showConfirmButton('باشه', '#3085d6');
            return back();
        }
        $payconfig = config('payment');
        $payment = new Payment($payconfig);
        $invoice = (new Invoice)->amount($paymentBank->price);
        return $payment->callbackUrl(env('CALLBACK_URL'))->purchase($invoice,function($driver, $transactionId) use ($paymentBank){
            $paymentModels = ModelsPayment::where('order_number',$paymentBank->order_number)->get();
            foreach($paymentModels as $paymentModel){
                $paymentModel->update([
                    'transactionId'=>$transactionId,
                    'driver'=>config('payment.default')
                ]);
            }
            $orders = order::where('order_count',$paymentBank->order_number)->get();
            foreach($orders as $order){
                $order->update([
                    'transactionId'=>$transactionId
                ]);
            }
        })->pay()->render();

    }

    public function callback()
    {
        $authority = request()->Authority;
        $status = request()->Status;
        if($status == "OK"){
           $payments = ModelsPayment::where('transactionId',$authority)->get();

           $bank_payments = bankPayment::where('order_number',$payments[0]->order_number)->get();

           $orders = order::where('order_count',$payments[0]->order_number)->get();

           foreach($payments as $payment){
            $payment->update([
                'status'=>1
            ]);
            $count_products = product::where('id',$payment->product_id)->get();
            foreach($count_products as $count_product){
                $count_product->update([
                    $count_product->number -=$payment->count
                ]);
            }
            $invoice = ModelsInvoice::create([
                'name_product'=>$payment->product->title,
                'type'=>$payment->type,
                'count_product'=>$payment->count,
                'price_product'=>$payment->product_price,
                'order_number'=>$payment->order_number,
                'name_customer'=>$payment->name,
                'family_customer'=>$payment->lname,
                'phone_customer'=>$payment->phone,
                'email_customer'=>$payment->email,
                'user_id_customer'=>$payment->user_id,
                'discount_code'=>$payment->discount_code,
                'discount_price'=>$payment->discount_price,
                'discount_percent'=>$payment->discount_percent,
                'payment_id'=>$payment->id,
                'transactionId'=>$payment->transactionId,
                'total_price'=>$payment->total_price,
                'size_product'=>$payment->color_id,
                'color_product'=>$payment->size_id,

            ]);
           }

           foreach($bank_payments as $bank_payment){
            $bank_payment->update([
                'status'=>1
            ]);
           }

           foreach($orders as $order){
            $order->update([
                'payment'=>1
            ]);
           }
           $carts = cart::where('user_id',auth()->user()->id)->get();
           foreach($carts as $cart){
            $cart->update([
                'status'=>1
            ]);
           }

           alert()->success('پرداخت موفق', 'خرید شما با موفقیت انجام شد')->showConfirmButton('باشه', '#3085d6');

           return redirect()->route('order.completed');
        }else{
            alert()->warning('پرداخت ناموفق', 'پرداخت با شکست مواجه شد')->showConfirmButton('باشه', '#3085d6');
            $paymentBank = bankPayment::where('user_id',auth()->user()->id)->where('status',0)->get()->last();

           $payment = ModelsPayment::where('order_number', $paymentBank->order_number)->get()->last();
           return redirect()->route('order.index',$payment->order_number);
        }
    }
}
