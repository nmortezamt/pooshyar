<?php

namespace App\Http\Livewire\Admin\DiscountBanner;

use App\Models\log;
use App\Models\newTask as ModelsNewTask;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewTask extends Component
{
    use WithFileUploads;
    public $image;
    public $readyToLoad = false;

    public ModelsNewTask $Discount;
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
        $this->Discount = new ModelsNewTask();
    }

    public function banner()
    {
        $this->validate();
        if(ModelsNewTask::count() < 3){
        $Discount = ModelsNewTask::query()->create([
            'link' => $this->Discount->link,
            'status' => $this->Discount->status ? 1 : 0,
        ]);
        if ($this->image) {
            $Discount->update([
                'img' => $this->images()
            ]);
        }
        $this->emit('toast', 'success', 'تسک جدید با موفقیت اضافه شد');
        $this->Discount->link = "";
        $this->Discount->status = false;
        $this->image = null;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن بنر تسک جدید تخفیفات' . ' :' . $Discount->link,
            'actionType' => 'ایجاد'
        ]);
        }else{
            $this->emit('toast', 'warning', 'بیش از سه بنر نمی توانید ایجاد کنید');

        }

    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "new-task/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function updateCategorydisable($id)
    {
        $Discount = ModelsNewTask::find($id);
        $Discount->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن تسک جدید تخفیفات' . ' :' . $Discount->link,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $Discount = ModelsNewTask::find($id);
        $Discount->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن تسک جدید تخفیفات' . " :" . $Discount->link,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $Discount = ModelsNewTask::find($remove);
        Storage::disk('public')->delete('uploads',$Discount->img);
            $Discount->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف تسک جدید تخفیفات' . ' :' . $Discount->link,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' بنر با موفقیت حذف شد');
    }

    public function render()
    {

        $Discounts = $this->readyToLoad ? ModelsNewTask::all() : [];
        return view('livewire.admin.discount-banner.new-task',compact('Discounts'));
    }
}
