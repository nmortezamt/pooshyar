<?php

namespace App\Http\Livewire\Admin\SubcategoryArticle;

use App\Models\log;
use App\Models\subcategoryArticle;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public subcategoryArticle $subcategory;

    protected $rules = [
        'subcategory.title' => 'required | min:3 | max:50',
        'subcategory.description' => 'nullable | min:20 | string',
        'subcategory.link' => 'required | max:50',
        'subcategory.category_article_id' => 'required',
        'image' => 'nullable | image | max:1000'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function subCategory()
    {
        $this->validate();
        if ($this->image) {
            if($this->subcategory->img){
                Storage::disk('public')->delete('uploads',$this->subcategory->img);
            }
            $this->subcategory->img = $this->images();
        }
        $this->subcategory->update($this->validate());
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش زیر دسته مقاله' . ' :' . $this->subcategory->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'زیر دسته مقاله با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('subcategory.article.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "subcategory-article/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }


    public function render()
    {
        $subcategory = $this->subcategory;
        return view('livewire.admin.subcategory-article.update',compact('subcategory'));
    }
}
