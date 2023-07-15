<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\payment as ModelsPayment;
use Livewire\Component;

class Payment extends Component
{
    public function payment($id)
    {
        $payment = ModelsPayment::find($id);
        if($payment->product->shipment == 1 && $payment->product->numbre > $payment->count){
            return redirect()->route('bank.payment.index',$payment->order_number);

        }else{
            $this->emit('toast', 'warning', 'این سفارش لغو شده است ');
            $payment->delete();
        }
    }
    public function render()
    {
        return view('livewire.home.profile.payment')->layout('layouts.profile');
    }
}
