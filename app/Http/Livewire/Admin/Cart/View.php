<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\cart;
use Livewire\Component;

class View extends Component
{
    public cart $cart;
    public function render()
    {
        $cart = $this->cart;
        return view('livewire.admin.cart.view',compact('cart'));
    }
}
