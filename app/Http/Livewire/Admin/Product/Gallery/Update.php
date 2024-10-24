<?php

namespace App\Http\Livewire\Admin\Product\Gallery;

use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Product\Gallery\Models\gallery;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public gallery $gallery;
    protected $rules = [
        'gallery.product_id'=> 'required',
        'gallery.position' => 'required | integer | max:15',
        'image' => 'nullable | image | max:1000'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function gallery()
    {
        $this->validate();
        if ($this->image) {
            Storage::disk('public')->delete('uploads', $this->gallery->img);
            $this->gallery->img = $this->images();
        }
        $this->gallery->update($this->validate());

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش تصویر محصول' . ' ' . $this->gallery->product_id,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'گالری محصول با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('gallery.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "gallery/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }


    public function render()
    {
        $gallerys = $this->gallery;

        return view('livewire.admin.product.gallery.update', compact('gallerys'));
    }
}
