<?php

namespace App\Http\Livewire\Admin\Product\Attributevalue;

use App\Models\attributeValue;
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

    public attributeValue $attributeValue;

    public function mount()
    {
        $this->attributeValue = new attributeValue();
    }

    protected $rules = [
        'attributeValue.value' => 'required | max:35',
        'attributeValue.product_id' => 'required',
        'attributeValue.attribute_id' => 'required',
        'attributeValue.status' => 'nullable',

    ];
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function attribute_value()
    {
        $this->validate();
        $attributeValue = attributeValue::query()->create([
            'value' => $this->attributeValue->value,
            'product_id' => $this->attributeValue->product_id,
            'attribute_id' => $this->attributeValue->attribute_id,
            'status' => $this->attributeValue->status ? 1 : 0,
        ]);

        $this->attributeValue->value = "";
        $this->attributeValue->product_id = null;
        $this->attributeValue->attribute_id = null;
        $this->attributeValue->status = false;

        $this->emit('toast', 'success', '  مقدار مشخصات کالا با موفقیت اضافه شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن مقدار مشخصات کالا' . ' :' . $attributeValue->value,
            'actionType' => 'ایجاد'
        ]);
    }


    public function updateCategorydisable($id)
    {
        $attributeValue = attributeValue::find($id);
        $attributeValue->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت مقدار مشخصات کالا با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن مقدار مشخصات کالا' . ' :' . $attributeValue->product->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $attributeValue = attributeValue::find($id);
        $attributeValue->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت مقدار مشخصات کالا با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن مقدار مشخصات کالا' . ' :' . $attributeValue->product->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $attributeValue = attributeValue::find($removeId);
        $attributeValue->delete();
        $this->emit('toast', 'success', ' مقدار مشخصات کالا با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف مقدار مشخصات کالا' . ' :' . $attributeValue->product->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $attributeValues = $this->readyToLoad ? attributeValue::where("value", "LIKE", "%{$this->search}%")
            ->orWhere("product_id", "LIKE", "%{$this->search}%")
            ->orWhere("attribute_id", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];

        return view('livewire.admin.product.attributevalue.index', compact('attributeValues'));
    }
}
