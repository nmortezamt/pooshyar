<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\payment;
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

    public function loadPayment()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $payments = $this->readyToLoad ? payment::where("order_number", "LIKE", "%{$this->search}%")
        ->orWhere("transactionId", "LIKE", "%{$this->search}%")
        ->orWhere("name", "LIKE", "%{$this->search}%")
        ->orWhere("lname", "LIKE", "%{$this->search}%")
        ->orWhere("phone", "LIKE", "%{$this->search}%")
        ->orWhere("email", "LIKE", "%{$this->search}%")
        ->orWhere("postal_code", "LIKE", "%{$this->search}%")
        ->orWhere("address", "LIKE", "%{$this->search}%")
        ->orWhere("state", "LIKE", "%{$this->search}%")
        ->orWhere("city", "LIKE", "%{$this->search}%")
        ->orWhere("ip", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(10) : [];
        return view('livewire.admin.payment.index',compact('payments'));
    }
}
