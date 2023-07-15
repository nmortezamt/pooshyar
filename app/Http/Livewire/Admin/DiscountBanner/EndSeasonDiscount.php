<?php

namespace App\Http\Livewire\Admin\DiscountBanner;

use App\Models\EndSeasonDiscount as ModelsEndSeasonDiscount;
use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EndSeasonDiscount extends Component
{
    use WithFileUploads;
    public $image;
    public $readyToLoad = false;

    public ModelsEndSeasonDiscount $Discount;
    protected $rules = [
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
        $this->Discount = new ModelsEndSeasonDiscount();
    }

    public function banner()
    {
        $this->validate();
        if(ModelsEndSeasonDiscount::first() == null){
        $Discount = ModelsEndSeasonDiscount::query()->create([
            'link' => $this->Discount->link,
            'status' => $this->Discount->status ? 1 : 0,
        ]);
        if ($this->image) {
            $Discount->update([
                'img' => $this->images()
            ]);
        }
        $this->emit('toast', 'success', 'بنر تخفیف آخر ماه با موفقیت اضافه شد');
        $this->Discount->link = "";
        $this->Discount->status = false;
        $this->image = null;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن بنر تخیف آخر ماه' . ' :' . $Discount->link,
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
        $directory = "end-season-discount/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function updateCategorydisable($id)
    {
        $Discount = ModelsEndSeasonDiscount::find($id);
        $Discount->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن بنر تخفیف آخر ماه' . ' :' . $Discount->link,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $Discount = ModelsEndSeasonDiscount::find($id);
        $Discount->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن بنر تخفیف آخر ماه' . " :" . $Discount->link,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $Discount = ModelsEndSeasonDiscount::find($remove);
        Storage::disk('public')->delete('uploads',$Discount->img);
            $Discount->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف بنر تخفیف آخر ماه' . ' :' . $Discount->link,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' بنر با موفقیت حذف شد');
    }

    public function render()
    {

        $Discounts = $this->readyToLoad ? ModelsEndSeasonDiscount::all() : [];
        return view('livewire.admin.discount-banner.end-season-discount',compact('Discounts'));
    }
}
