<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Models\invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadInvoice()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $invoices = $this->readyToLoad ? invoice::where("order_number", "LIKE", "%{$this->search}%")
        ->orWhere("transactionId", "LIKE", "%{$this->search}%")
        ->orWhere("name_customer", "LIKE", "%{$this->search}%")
        ->orWhere("family_customer", "LIKE", "%{$this->search}%")
        ->orWhere("phone_customer", "LIKE", "%{$this->search}%")
        ->orWhere("email_customer", "LIKE", "%{$this->search}%")
        ->orWhere("name_product", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(20) : [];
        return view('livewire.admin.invoice.index',compact('invoices'));
    }
}
