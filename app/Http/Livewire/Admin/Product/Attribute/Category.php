<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\attribute;
use App\Models\childcategory;
use App\Models\log;
use App\Models\subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;


    public subcategory $subcategroy;
    public attribute $attribute;

    protected $rules = [
        'attribute.title'=>'required | max:20',
        'attribute.position'=>'required | integer | max:5',
        'attribute.parent'=>'required',
        'attribute.status'=>'nullable',
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
        $this->attribute = new attribute();
    }

    public function attribute()
    {
        $this->validate();
        $attribute = attribute::query()->create([
            'title' =>$this->attribute->title,
            'subcategory_id' =>$this->subcategroy->id,
            'position' =>$this->attribute->position,
            'parent' =>$this->attribute->parent,
            'status' =>$this->attribute->status ? 1:0,
        ]);

        $this->attribute->title = "";
        $this->attribute->position = "";
        $this->attribute->parent = null;
        $this->attribute->status = false;


        $this->emit('toast', 'success', ' مقدار مشخصه کالا با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن مقدار مشخصه کالا' . ' :' . $attribute->title,
            'actionType' => 'ایجاد'
        ]);

    }
    public function updateCategorydisable($id)
    {
        $attribute = attribute::find($id);
        $attribute->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'مقدار مشخصه کالا با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن مقدار مشخصه کالا' . ' :' . $attribute->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $attribute = attribute::find($id);
        $attribute->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'مقدار مشخصه کالا با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن مقدار مشخصه کالا ' . " :" . $attribute->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $attribute = attribute::find($removeId);
        $attribute->delete();
        $this->emit('toast', 'success', ' مقدار مشخصه کالا  با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کامل مقدار مشخصه کالا ' . ' :' . $attribute->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $subcategroy = $this->subcategroy;
        $attributes = $this->readyToLoad ? attribute::
        where("subcategory_id",$this->subcategroy->id)
        ->orderBy('position')->paginate(10) : [];

        return view('livewire.admin.product.attribute.category',compact('subcategroy','attributes'));
    }
}
