<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\attribute;
use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public attribute $attribute;

    public function mount()
    {
        $this->attribute = new attribute();
    }

    protected $rules = [
        'attribute.title' => 'required | max:20',
        'attribute.subcategory_id' => 'required',
        'attribute.position' => 'required | integer | max:5',
        'attribute.parent' => 'required',
        'attribute.status' => 'nullable',

    ];
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function attribute()
    {
        $this->validate();
        $attribute = attribute::query()->create([
            'title' => $this->attribute->title,
            'subcategory_id' => $this->attribute->subcategory_id,
            'position' => $this->attribute->position,
            'parent' => $this->attribute->parent,
            'status' => $this->attribute->status ? 1 : 0,
        ]);



        $this->attribute->title = "";
        $this->attribute->subcategory_id = null;
        $this->attribute->position = "";
        $this->attribute->parent = null;
        $this->attribute->status = false;

        $this->emit('toast', 'success', '  مشخصات کالا با موفقیت اضافه شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن مشخصات کالا' . ' :' . $attribute->title,
            'actionType' => 'ایجاد'
        ]);
    }


    public function updateCategorydisable($id)
    {
        $attribute = attribute::find($id);
        $attribute->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت مشخصات کالا با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن مشخصات کالا' . ' :' . $attribute->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $attribute = attribute::find($id);
        $attribute->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت مشخصات کالا با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن مشخصات کالا' . ' :' . $attribute->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $attribute = attribute::find($removeId);
        $attribute->delete();
        $this->emit('toast', 'success', ' مشخصات کالا با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف مشخصات کالا' . ' :' . $attribute->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $attributes = $this->readyToLoad ? attribute::where("title", "LIKE", "%{$this->search}%")
            // ->orWhere("childcategory","LIKE","%{$this->search}%")
            ->orWhere("position", "LIKE", "%{$this->search}%")
            ->orWhere("parent", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];

        return view('livewire.admin.product.attribute.index', compact('attributes'));
    }
}
