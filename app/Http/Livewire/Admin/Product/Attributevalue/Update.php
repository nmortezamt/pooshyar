<?php

namespace App\Http\Livewire\Admin\Product\Attributevalue;

use App\Models\attribute;
use App\Models\attributeValue;
use App\Models\log;
use Livewire\Component;
use Modules\Product\Product\Models\product;

class Update extends Component
{
    public attributeValue $attributeValue;

    protected $rules = [
        'attributeValue.value' => 'required | max:35',
        'attributeValue.product_id' => 'required',
        'attributeValue.attribute_id' => 'required',
        'attributeValue.status' => 'nullable',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function attribute_value()
    {
        $this->validate();
        $this->attributeValue->update($this->validate());
        if (!$this->attributeValue->status) {
            $this->attributeValue->update(['status' => 0]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش مقدار مشخصه کالا' . ' :' . $this->attributeValue->product_id,
            'actionType' => 'آپدیت'
        ]);

        alert()->success('موفقیت', 'مقدار مشخصات کالا با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('attributevalue.index'));
    }


    public function render()
    {
        if ($this->attributeValue->status == 1) {
            $this->attributeValue->status = true;
        } else {
            $this->attributeValue->status = false;
        }
        $attributeValue = $this->attributeValue;
        $product = product::find($attributeValue->product_id);
        $att = attribute::where('parent', '>', 0)
            ->where('subcategory_id', $product->subcategory_id)->get();
        return view('livewire.admin.product.attributevalue.update',compact('att'));
    }
}
