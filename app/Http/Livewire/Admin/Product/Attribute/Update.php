<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\attribute;
use App\Models\log;
use Livewire\Component;

class Update extends Component
{
    public attribute $attribute;

    protected $rules = [
        'attribute.title' => 'required | max:20',
        'attribute.subcategory_id' => 'required',
        'attribute.position' => 'required | integer',
        'attribute.parent' => 'required',
        'attribute.status' => 'nullable',

    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function categoryForm()
    {
        $this->validate();
        $this->attribute->update($this->validate());
        if (!$this->attribute->status) {
            $this->attribute->update(['status' => 0]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش مشخصات کالا' . ' :' . $this->attribute->title,
            'actionType' => 'آپدیت'
        ]);

        alert()->success('موفقیت', 'مشخصات کالا با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');


        return redirect(route('attribute.index'));
    }


    public function render()
    {
        if ($this->attribute->status == 1) {
            $this->attribute->status = true;
        } else {
            $this->attribute->status = false;
        }
        $attributes = $this->attribute;
        return view('livewire.admin.product.attribute.update', compact('attributes'));
    }
}
