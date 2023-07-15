<?php

namespace App\Http\Livewire\Admin\DiscountBanner;

use App\Models\log;
use App\Models\specialDiscount as ModelsSpecialDiscount;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SpecialDiscount extends Component
{
    use WithFileUploads;
    public $image;
    public $readyToLoad = false;

    public ModelsSpecialDiscount $Discount;
    protected $rules = [
        'Discount.title' => 'required |min:3 | max:30',
        'Discount.link' => 'required | max:30',
        'Discount.status' => 'nullable',
        'image' => 'required | image | max:1000'
    ];
    public function loadBanner()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->Discount = new ModelsSpecialDiscount();
    }

    public function banner()
    {
        $this->validate();
        if(ModelsSpecialDiscount::first() == null){
        $Discount = ModelsSpecialDiscount::query()->create([
            'link' => $this->Discount->link,
            'title' => $this->Discount->title,
            'status' => $this->Discount->status ? 1 : 0,
        ]);
        if ($this->image) {
            $Discount->update([
                'img' => $this->images()
            ]);
        }
        $this->emit('toast', 'success', 'بنر تخفیف آخر ماه با موفقیت اضافه شد');
        $this->Discount->link = "";
        $this->Discount->title = "";
        $this->Discount->status = false;
        $this->image = null;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن بنر تخفیف ویژه' . ' :' . $Discount->title,
            'actionType' => 'ایجاد'
        ]);
        }else{
            $this->emit('toast', 'warning', 'بیش از یک بنر نمی توانید ایجاد کنید');

        }

    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "special-discount/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function updateCategorydisable($id)
    {
        $Discount = ModelsSpecialDiscount::find($id);
        $Discount->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن بنر تخفیف ویژه' . ' :' . $Discount->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $Discount = ModelsSpecialDiscount::find($id);
        $Discount->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن بنر تخفیف ویژه' . " :" . $Discount->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $Discount = ModelsSpecialDiscount::find($remove);
        Storage::disk('public')->delete('uploads',$Discount->img);
            $Discount->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف بنر تخفیف ویژه' . ' :' . $Discount->title,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' بنر با موفقیت حذف شد');
    }

    public function render()
    {

        $Discounts = $this->readyToLoad ? ModelsSpecialDiscount::all() : [];
        return view('livewire.admin.discount-banner.special-discount',compact('Discounts'));
    }
}
