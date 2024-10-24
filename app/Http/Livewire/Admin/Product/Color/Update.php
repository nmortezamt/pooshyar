<?php

namespace App\Http\Livewire\Admin\Product\Color;

use App\Models\log;
use Livewire\Component;
use Modules\Product\Color\Models\color;

class Update extends Component
{
    public color $color;
    protected $rules = [
        'color.value' => 'required | max:8',
        'color.product_id' => 'required',
        'color.name' => 'required | max:20',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function color()
    {
        $this->validate();
        $this->color->update($this->validate());

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش رنگ' . ' :' . $this->color->name,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'رنگ با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('color.index'));
    }

    public function render()
    {
        $colors = $this->color;
        return view('livewire.admin.product.color.update', compact('colors'));
    }
}
