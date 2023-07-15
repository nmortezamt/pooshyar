<?php

namespace App\Http\Livewire\Admin\Cart;

use App\Models\cart;
use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadCart()
    {
        $this->readyToLoad = true;
    }

    public function remove($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف سبد خرید' . ' :' . $cart->id,
            'actionType' => 'حذف'
        ]);
        $this->emit('toast', 'success', ' سبد خرید با موفقیت حذف شد');
    }

    public function render()
    {
        $carts = $this->readyToLoad ? cart::where("product_id", "LIKE", "%{$this->search}%")
            ->orWhere("type", "LIKE", "%{$this->search}%")
            ->orWhere("ip", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.cart.index', compact('carts'));
    }
}
