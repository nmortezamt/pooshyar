<?php

namespace App\Http\Livewire\Admin\Product\Size;

use App\Models\log;
use App\Models\product as ModelsProduct;
use App\Models\size;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $readyToLoad = false;
    public ModelsProduct $product;
    public size $size;

    protected $rules = [
        'size.name' => 'required | max:20',
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
        $this->size = new size();
    }

    public function size()
    {
        $this->validate();
        $this->size->product_id = $this->product->id;
        $size = size::query()->create([
            'product_id' => $this->size->product_id,
            'name' => $this->size->name,
        ]);

        $this->size->product_id = null;
        $this->size->name = "";

        $this->emit('toast', 'success', ' سایز محصول با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن سایز محصول' . ' :' . $size->name,
            'actionType' => 'ایجاد'
        ]);
    }


    public function remove($removeId)
    {
        $size = size::find($removeId);
        $size->delete();
        $this->emit('toast', 'success', ' سایز محصول با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کامل سایز محصول' . ' :' . $size->name,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $sizes = $this->readyToLoad ? size::where("product_id", $this->product->id)
            ->orderBy('name')->paginate(10) : [];
        return view('livewire.admin.product.size.product',compact('sizes'));
    }
}
