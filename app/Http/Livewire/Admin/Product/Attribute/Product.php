<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\attributeValue;
use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Product\Models\product as ModelsProduct;

class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;


    public ModelsProduct $product;
    public attributeValue $attributeValue;

    protected $rules = [
        'attributeValue.value'=>'required',
        'attributeValue.attribute_id'=>'required',
        'attributeValue.status'=>'nullable',
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
        $this->attributeValue = new attributeValue();
    }

    public function attribute()
    {
        $this->validate();
        $attributeValue = attributeValue::query()->create([
            'value' =>$this->attributeValue->value,
            'product_id' =>$this->product->id,
            'attribute_id' =>$this->attributeValue->attribute_id,
            'status' =>$this->attributeValue->status ? 1:0,
        ]);

        $this->attributeValue->value = "";
        $this->attributeValue->attribute_id = null;
        $this->attributeValue->status = false;

        $this->emit('toast', 'success', ' مقدار مشخصه کالا با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن مقدار مشخصه کالا' . ' :' .$attributeValue->value,
            'actionType' => 'ایجاد'
        ]);

    }
    public function updateCategorydisable($id)
    {
        $attributeValue = attributeValue::find($id);
        $attributeValue->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'مقدار مشخصه کالا با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن مقدار مشخصه کالا' . ' :' . $attributeValue->value,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $attributeValue = attributeValue::find($id);
        $attributeValue->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'مقدار مشخصه کالا با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن مقدار مشخصه کالا ' . " :" . $attributeValue->value,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $attributeValue = attributeValue::find($removeId);
        $attributeValue->delete();
        $this->emit('toast', 'success', ' مقدار مشخصه کالا  با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کامل مقدار مشخصه کالا ' . ' :' . $attributeValue->value,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $product = $this->product;
        $attributevalues = $this->readyToLoad ? attributeValue::
        where("product_id",$this->product->id)
        ->orderBy('product_id')->paginate(10) : [];
        return view('livewire.admin.product.attribute.product',compact('product','attributevalues'));
    }
}
