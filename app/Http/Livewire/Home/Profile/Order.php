<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\order as ModelsOrder;
use App\Models\payment;
use Livewire\Component;

class Order extends Component
{
    public function payment($id)
    {
        $payment = payment::where('order_number',$id)->first();
        if(isset($payment)){
            if($payment->product->shipment == 1 && $payment->product->numbre > $payment->count){
                return redirect()->route('bank.payment.index',$payment->order_number);

            }else{
                $this->emit('toast', 'warning', 'این سفارش لغو شده است ');
                $payment->delete();
            }
        }else{
            return redirect()->route('order.index',$id);
        }

    }

    public function render()
    {
        $orders = ModelsOrder::where('user_id',auth()->user()->id)->get();
        return view('livewire.home.profile.order',compact('orders'))->layout('layouts.profile');
    }
}
