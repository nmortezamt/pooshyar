<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\category;
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

    public Category $category;
    protected $rules = [
        'category.title' => 'required |min:3 | max:30',
        'category.description' => 'nullable | min:20 | string',
        'category.link' => 'required | max:30',
        'category.status' => 'nullable',
        'image' => 'required | image | max:1000'
    ];
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->category = new category();
    }

    public function category()
    {
        $this->validate();
        $category = category::query()->create([
            'title' => $this->category->title,
            'description' => $this->category->description,
            'link' => $this->category->link,
            'status' => $this->category->status ? 1 : 0,
        ]);
        if ($this->image) {
            $category->update([
                'img' => $this->images()
            ]);
        }
        $this->emit('toast', 'success', ' دسته با موفقیت اضافه شد');
        $this->category->title = "";
        $this->category->description = "";
        $this->category->link = "";
        $this->category->status = false;
        $this->image = null;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن دسته' . ' :' . $category->title,
            'actionType' => 'ایجاد'
        ]);
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

    public function updateCategorydisable($id)
    {
        $categoy = category::find($id);
        $categoy->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت دسته با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن دسته' . ' :' . $categoy->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $category = category::find($id);
        $category->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت دسته با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن دسته' . " :" . $category->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $categories = category::find($remove);
        $subcategory =  subcategory::where('parent', $remove)->first();
        if ($subcategory == null) {
            $categories->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف دسته' . ' :' . $categories->title,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' دسته با موفقیت حذف شد');
        } else {
            $this->emit('toast', 'warning', ' امکان حذف وجود ندارد زیرا شامل زیر دسته است!');
        }
    }

    public function render()
    {

        $categories = $this->readyToLoad ? category::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("link", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.category.index', compact('categories'));
    }
}
