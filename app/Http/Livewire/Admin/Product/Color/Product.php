<?php

namespace App\Http\Livewire\Admin\Product\Color;

use App\Models\color;
use App\Models\log;
use App\Models\product as ModelsProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $readyToLoad = false;
    public ModelsProduct $product;
    public color $color;

    protected $rules = [
        'color.value' => 'required | max:8',
        'color.product_id' => 'nullable',
        'color.name' => 'required | max:20',
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
        $this->color = new color();
    }

    public function color()
    {
        $this->validate();
        $this->color->product_id = $this->product->id;
        $color = color::query()->create([
            'product_id' => $this->color->product_id,
            'name' => $this->color->name,
            'value' => $this->color->value,
        ]);

        $this->color->product_id = null;
        $this->color->value = "";
        $this->color->name = "";

        $this->emit('toast', 'success', ' رنگ محصول با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن رنگ محصول' . ' :' . $color->name,
            'actionType' => 'ایجاد'
        ]);
    }


    public function remove($removeId)
    {
        $color = color::find($removeId);
        $color->delete();
        $this->emit('toast', 'success', ' رنگ محصول با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کامل رنگ محصول' . ' :' . $color->name,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $colors = $this->readyToLoad ? color::where("product_id", $this->product->id)
            ->orderBy('name')->paginate(10) : [];
        return view('livewire.admin.product.color.product', compact('colors'));
    }
}
