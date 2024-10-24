<?php

namespace App\Http\Livewire\Admin\Product\Color;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Color\Models\color;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public color $color;

    protected $rules = [
        'color.value' => 'required | max:8',
        'color.product_id' => 'required',
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

        $color = color::query()->create([
            'value' => $this->color->value,
            'name' => $this->color->name,
            'product_id' => $this->color->product_id,
        ]);


        $this->color->value = "";
        $this->color->name = "";
        $this->color->product_id = null;

        $this->emit('toast', 'success', ' رنگ با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن رنگ' . ' :' . $color->name,
            'actionType' => 'ایجاد'
        ]);
    }


    public function remove($removeId)
    {
        $color = color::find($removeId);
        $color->delete();
        $this->emit('toast', 'success', ' رنگ با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف رنگ' . ' :' . $color->name,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $colors = $this->readyToLoad ? $colors = color::where("name", "LIKE", "%{$this->search}%")
            ->orWhere("value", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.product.color.index', compact('colors'));
    }
}
