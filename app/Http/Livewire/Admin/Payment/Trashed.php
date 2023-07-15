<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\log;
use App\Models\payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadPayment()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $payment = payment::onlyTrashed()->find($removeId);
        $payment->forceDelete();
        $this->emit('toast', 'success', ' پرداخت ناموفق به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه پرداخت ناموفق حذف شد' . ' :' . $payment->product->title,
            'actionType' => 'حذف کامل'
        ]);
    }


    public function render()
    {
        $payments = $this->readyToLoad ? DB::table('payments')->whereNotNull('deleted_at')
            ->latest()->paginate(20) : [];
        return view('livewire.admin.payment.trashed',compact('payments'));
    }
}
