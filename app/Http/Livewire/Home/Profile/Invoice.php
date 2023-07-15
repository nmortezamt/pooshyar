<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\bankPayment;
use App\Models\invoice as ModelsInvoice;
use App\Models\order;
use App\Models\payment;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Invoice extends Component
{
    public $invoice;


    public function mount(ModelsInvoice $id)
    {
        $this->invoice = $id;

    }
    public function render()
    {
        $invoice = ModelsInvoice::where('id',$this->invoice)->first();
        return view('livewire.home.profile.invoice',compact('invoice'))->layout('layouts.invoice');
    }
}
