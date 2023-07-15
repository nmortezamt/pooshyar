<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\order;
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

    public function loadOrder()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $orders = $this->readyToLoad ? order::where("order_count", "LIKE", "%{$this->search}%")
        ->orWhere("transactionId", "LIKE", "%{$this->search}%")
        ->orWhere("ip", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(10) : [];
        return view('livewire.admin.order.index',compact('orders'));
    }
}
