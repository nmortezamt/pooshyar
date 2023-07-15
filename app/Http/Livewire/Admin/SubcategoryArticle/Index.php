<?php

namespace App\Http\Livewire\Admin\SubcategoryArticle;

use App\Models\log;
use App\Models\subcategoryArticle;
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

    public subcategoryArticle $subcategories;

    public function mount()
    {
        $this->subcategories = new subcategoryArticle();
    }

    protected $rules = [
        'subcategories.title' => 'required | min:3 | max:50',
        'subcategories.description' => 'nullable | min:20 | string',
        'subcategories.link' => 'required | max:50',
        'subcategories.category_article_id' => 'required',
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
        $subcategory = subcategoryArticle::query()->create([
            'title' => $this->subcategories->title,
            'description' => $this->subcategories->description,
            'link' => $this->subcategories->link,
            'category_article_id' => $this->subcategories->category_article_id,
        ]);

        if ($this->image) {
            $subcategory->update([
                'img' => $this->images()
            ]);
        }
        $this->subcategories->title = "";
        $this->subcategories->description = "";
        $this->subcategories->link = "";
        $this->subcategories->category_article_id = null;
        $this->image = null;

        $this->emit('toast', 'success', ' زیر دسته مقاله با موفقیت اضافه شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن زیر دسته مقاله' . ' :' . $subcategory->title,
            'actionType' => 'ایجاد'
        ]);
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

    public function remove($removeId)
    {
        $subcategory = subcategoryArticle::find($removeId);
            $subcategory->delete();
            $this->emit('toast', 'success', ' زیر دسته مقاله با موفقیت حذف شد');
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف زیر دسته مقاله' . ' :' . $subcategory->title,
                'actionType' => 'حذف'
            ]);

    }

    public function render()
    {
        $subcategorys = $this->readyToLoad ? subcategoryArticle::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.subcategory-article.index',compact('subcategorys'));
    }
}
