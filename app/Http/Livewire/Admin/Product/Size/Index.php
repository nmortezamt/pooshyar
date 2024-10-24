<?php

namespace App\Http\Livewire\Admin\Product\Size;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Size\Models\size;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public size $size;

    protected $rules = [
        'size.product_id' => 'required',
        'size.name' => 'required | max:20',

    ];
    public function loadSize()
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

        $size = size::query()->create([
            'name' => $this->size->name,
            'product_id' => $this->size->product_id,
        ]);


        $this->size->name = "";
        $this->size->product_id = null;

        $this->emit('toast', 'success', ' سایز با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن سایز' . ' :' . $size->name,
            'actionType' => 'ایجاد'
        ]);
    }


    public function remove($removeId)
    {
        $size = size::find($removeId);
        $size->delete();
        $this->emit('toast', 'success', ' سایز با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف سایز' . ' :' . $size->name,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $sizes = $this->readyToLoad ? size::where("name", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.product.size.index',compact('sizes'));
    }
}
