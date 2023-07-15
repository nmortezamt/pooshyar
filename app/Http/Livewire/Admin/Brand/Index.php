<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\brand;
use App\Models\log;
use App\Models\product;
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

    public brand $brand;

    protected $rules = [
        'brand.description' => 'nullable |min:3',
        'brand.name' => 'required',
        'brand.link' => 'required',
        'brand.status' => 'nullable',
        'brand.category_id' => 'required',
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

    public function mount()
    {
        $this->brand = new brand();
    }

    public function brand()
    {
        $this->validate();
        $brand = brand::query()->create([
            'description' => $this->brand->description,
            'name' => $this->brand->name,
            'link' => $this->brand->link,
            'category_id' => $this->brand->category_id,
            'status' => $this->brand->status ? 1 : 0,
        ]);

        if ($this->image) {
            $brand->update([
                'img' => $this->images()
            ]);
        }

        $this->brand->description = "";
        $this->brand->name = "";
        $this->brand->link = "";
        $this->brand->category_id = null;
        $this->brand->status = false;
        $this->image = null;

        $this->emit('toast', 'success', ' برند با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن برند' . ' :' . $brand->name,
            'actionType' => 'ایجاد'
        ]);
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

    public function updateCategorydisable($id)
    {
        $brand = brand::find($id);
        $brand->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت برند با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن برند' . ' :' . $brand->name,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $brand = brand::find($id);
        $brand->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت برند با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن برند' . " :" . $brand->name,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $brand = brand::find($removeId);
        $product = product::where('brand_id', $removeId)->first();
        if ($product == null) {
            $brand->delete();
            $this->emit('toast', 'success', ' برند با موفقیت حذف شد');
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف برند' . ' :' . $brand->name,
                'actionType' => 'حذف'
            ]);
        } else {
            $this->emit('toast', 'warning', ' امکان حذف ندارد زیرا این برند، شامل محصول  است !');
        }
    }

    public function render()
    {

        $brands = $this->readyToLoad ? $brands = brand::where("description", "LIKE", "%{$this->search}%")
            ->orWhere("name", "LIKE", "%{$this->search}%")
            ->orWhere("link", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.brand.index', compact('brands'));
    }
}
