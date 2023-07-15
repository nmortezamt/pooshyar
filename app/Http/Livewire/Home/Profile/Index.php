<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\payment;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $user;
    public function payment($id)
    {
        $payment = payment::findOrFail($id);
        if($payment->product->shipment == 1){
            return redirect()->route('bank.payment.index',$payment->order_number);

        }else{
            $this->emit('toast', 'warning', 'این سفارش لغو شده است ');
            $payment->delete();
        }
    }

    public function mount()
    {
        $this->user = new User();
    }

    protected $rules =[
        'user.name'=>'nullable',
        'user.email'=>'nullable',
        'user.number'=>'nullable',
        'user.password1'=>'nullable',
        'user.password2'=>'nullable',
        'user.password3'=>'nullable',
    ];

    public function updateAccount()
    {

        if($this->user->name){
            $this->user->update([
                'name'=>$this->user->name
            ]);
            dd($this->user->name);
        }
    }
    public function render()
    {
        return view('livewire.home.profile.index')->layout('layouts.profile');
    }
}
