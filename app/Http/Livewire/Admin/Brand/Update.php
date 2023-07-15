<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\brand;
use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public brand $brand;
    protected $rules = [
        'brand.description' => 'nullable | min:3',
        'brand.name' => 'required',
        'brand.link' => 'required',
        'brand.status' => 'nullable',
        'brand.category_id' => 'required',
        'image' => 'nullable | image | max:1000'

    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function categoryForm()
    {
        $this->validate();
        if ($this->image) {
            if ($this->brand->img) {
                Storage::disk('public')->delete('uploads', $this->brand->img);
            }
            $this->brand->img = $this->images();
        }
        $this->brand->update($this->validate());
        if (!$this->brand->status) {
            $this->brand->update(['status' => 0]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش برند' . ' ' . $this->brand->name,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'برند با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('brand.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "brand/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }


    public function render()
    {
        if ($this->brand->status == 1) {
            $this->brand->status = true;
        } else {
            $this->brand->status = false;
        }
        $brands = $this->brand;

        return view('livewire.admin.brand.update', compact('brands'));
    }
}
