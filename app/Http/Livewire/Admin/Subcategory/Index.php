<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\childcategory;
use App\Models\log;
use App\Models\subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public subcategory $subcategories;

    public function mount()
    {
        $this->subcategories = new subcategory();
    }

    protected $rules = [
        'subcategories.title' => 'required | min:3 | max:30',
        'subcategories.description' => 'nullable | min:20 | string',
        'subcategories.link' => 'required | min:3 | max:50',
        'subcategories.parent' => 'required',
        'image' => 'nullable | image | max:1000'

    ];
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function subCategory()
    {
        $this->validate();
        $subcategory = subcategory::query()->create([
            'title' => $this->subcategories->title,
            'description' => $this->subcategories->description,
            'link' => $this->subcategories->link,
            'parent' => $this->subcategories->parent,
        ]);

        if ($this->image) {
            $subcategory->update([
                'img' => $this->images()
            ]);
        }
        $this->subcategories->title = "";
        $this->subcategories->description = "";
        $this->subcategories->link = "";
        $this->subcategories->parent = null;
        $this->image = null;

        $this->emit('toast', 'success', ' زیر دسته با موفقیت اضافه شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن زیر دسته' . ' :' . $subcategory->title,
            'actionType' => 'ایجاد'
        ]);
    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "subcategory/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function remove($removeId)
    {
        $subcategory = subcategory::find($removeId);
            $subcategory->delete();
            $this->emit('toast', 'success', ' زیر دسته با موفقیت حذف شد');
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف زیر دسته' . ' :' . $subcategory->title,
                'actionType' => 'حذف'
            ]);

    }

    public function render()
    {
        $subcategorys = $this->readyToLoad ? subcategory::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];

        return view('livewire.admin.subcategory.index', compact('subcategorys'));
    }
}
