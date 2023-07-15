<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\payment;
use Livewire\Component;

class View extends Component
{
    public payment $payment;
    public function render()
    {
        $payment = $this->payment;

        return view('livewire.admin.payment.view',compact('payment'));
    }
}
