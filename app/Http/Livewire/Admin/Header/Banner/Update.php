<?php

namespace App\Http\Livewire\Admin\Header\Banner;

use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Banner\Models\Banner;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public Banner $banner;
    protected $rules = [
        'banner.title' => 'required | min:3 | max:100',
        'banner.link' => 'required | max:100',
        'banner.description' => 'required | max:100',
        'banner.status' => 'nullable',
        'image' => 'nullable | image | max:1000'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function banner()
    {
        $this->validate();
        if ($this->image) {
            if($this->banner->img)
            {
                Storage::disk('public')->delete('uploads',$this->banner->img);
            }
            $this->banner->img = $this->images();
        }
        $this->banner->update($this->validate());
        if (!$this->banner->status) {
            $this->banner->update(['status' => 0]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش بنر صفحه اصلی' . ' ' . $this->banner->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'بنر با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('banner.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "banner/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        if ($this->banner->status == 1) {
            $this->banner->status = true;
        } else {
            $this->banner->status = false;
        }

        $banner = $this->banner;
        return view('livewire.admin.header.banner.update',compact('banner'));
    }
}
