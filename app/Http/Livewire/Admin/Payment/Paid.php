<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\bankPayment;
use Livewire\Component;
use Livewire\WithPagination;

class Paid extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadBankPayment()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $bankPaid = $this->readyToLoad ? bankPayment::where("order_number", "LIKE", "%{$this->search}%")
        ->orWhere("price", "LIKE", "%{$this->search}%")
        ->orWhere("ip", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(10) : [];
        return view('livewire.admin.payment.paid',compact('bankPaid'));
    }
}
