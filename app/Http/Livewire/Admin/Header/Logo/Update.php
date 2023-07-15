<?php

namespace App\Http\Livewire\Admin\Header\Logo;

use App\Models\log;
use App\Models\logoSite;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public logoSite $logo;
    protected $rules = [
        'image' => 'nullable | image | max:1000'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function logo()
    {
        $this->validate();
        if ($this->image) {
            Storage::disk('public')->delete('uploads',$this->logo->img);
            $this->logo->update([
                'img'=>$this->images()
            ]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش لوگو' . ' ' . $this->logo->id,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'لوگو سایت با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('logo.index'));
    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "logo/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }
    public function render()
    {
        $logo = $this->logo;
        return view('livewire.admin.header.logo.update',compact('logo'));
    }
}
