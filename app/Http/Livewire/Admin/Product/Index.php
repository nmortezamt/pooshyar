<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Product\Models\product;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;


    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function updateCategorydisable($id)
    {
        $product = product::find($id);
        $product->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت محصول با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن محصول' . ' :' . $product->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $product = product::find($id);
        $product->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت محصول با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن محصول' . " :" . $product->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($removeId)
    {
        $product = product::find($removeId);
        $product->delete();
        $this->emit('toast', 'success', ' محصول با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف محصول' . ' :' . $product->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $products = $this->readyToLoad ? product::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("link", "LIKE", "%{$this->search}%")
            ->orWhere("body", "LIKE", "%{$this->search}%")
            ->orWhere("description", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(5) : [];
        return view('livewire.admin.product.index', compact('products'));
    }
}
