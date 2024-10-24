<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Category\Models\category;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public category $category;
    protected $rules = [
        'category.title' => 'required |min:3 | max:30',
        'category.description' => 'nullable | min:20 | string',
        'category.link' => 'required | max:30',
        'category.status' => 'nullable',
        'image' => 'nullable | image | max:1000',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function category()
    {
        $this->validate();
        if ($this->image) {
            if($this->category->img)
            {
                Storage::disk('public')->delete('uploads',$this->category->img);
            }
            $this->category->img = $this->images();
        }
        $this->category->update($this->validate());
        if (!$this->category->status) {
            $this->category->update(['status' => 0]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش دسته' . ' ' . $this->category->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'دسته با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('category.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "category/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        if ($this->category->status == 1) {
            $this->category->status = true;
        } else {
            $this->category->status = false;
        }

        $category = $this->category;
        return view('livewire.admin.category.update', compact('category'));
    }
}
