<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\discountCode;
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

    public discountCode $discount;
    protected $rules = [
        'discount.price' => 'nullable',
        'discount.percent' => 'nullable',
        'discount.date' => 'required',
        'discount.status' => 'nullable',
    ];
    public function loadDiscount()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->discount = new discountCode();
    }

    public function discount()
    {
        $this->validate();
        $code = random_int(1000000000,9999999999);
        $discount = discountCode::query()->create([
            'price' => $this->discount->price,
            'percent' => $this->discount->percent,
            'date' => $this->discount->date,
            'code' => $code,
            'status' => $this->discount->status ? 1 : 0,
        ]);

        $this->emit('toast', 'success', ' دسته با موفقیت اضافه شد');
        $this->discount->price = "";
        $this->discount->percent = "";
        $this->discount->date = null;
        $this->discount->status = false;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن کد تخفیف' . ' :' . $discount->code,
            'actionType' => 'ایجاد'
        ]);
    }

    public function updateCategorydisable($id)
    {
        $categoy = discountCode::find($id);
        $categoy->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت کد تخفیف با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن کد تخفیف' . ' :' . $categoy->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $discount = discountCode::find($id);
        $discount->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت کد تخفیف با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن کد تخفیف' . " :" . $discount->زcode,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $discount = discountCode::find($remove);
            $discount->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کد تخفیف' . ' :' . $discount->code,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' کد تخفیف با موفقیت حذف شد');

    }

    public function render()
    {

        $discounts = $this->readyToLoad ? discountCode::where("price", "LIKE", "%{$this->search}%")
            ->orWhere("percent", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(20) : [];
        return view('livewire.admin.discount.index',compact('discounts'));
    }
}
