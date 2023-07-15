<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\log;
use App\Models\order;
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

    public function loadOrder()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $order = order::onlyTrashed()->find($removeId);
        $order->forceDelete();
        $this->emit('toast', 'success', ' سفارش پرداخت نشده به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه سفارش پرداخت نشده حذف شد' . ' :' . $order->product->title,
            'actionType' => 'حذف کامل'
        ]);
    }


    public function render()
    {
        $orders = $this->readyToLoad ? DB::table('orders')->whereNotNull('deleted_at')
            ->latest()->paginate(20) : [];
        return view('livewire.admin.order.trashed',compact('orders'));
    }
}
