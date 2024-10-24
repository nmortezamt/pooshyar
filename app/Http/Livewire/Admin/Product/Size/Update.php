<?php

namespace App\Http\Livewire\Admin\Product\Size;

use App\Models\log;
use Livewire\Component;
use Modules\Product\Size\Models\size;

class Update extends Component
{
    public size $size;
    protected $rules = [
        'size.product_id' => 'required',
        'size.name' => 'required | max:20',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function size()
    {
        $this->validate();
        $this->size->update($this->validate());

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش سایز' . ' :' . $this->size->name,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'سایز با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('size.index'));
    }

    public function render()
    {
        $size = $this->size;
        return view('livewire.admin.product.size.update',compact('size'));
    }
}
