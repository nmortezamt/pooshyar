<?php

namespace App\Http\Livewire\Admin\Product\Gallery;

use App\Models\gallery;
use App\Models\log;
use App\Models\product as ModelsProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Product extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $readyToLoad = false;
    public ModelsProduct $product;
    public gallery $gallery;

    protected $rules = [
        'gallery.position' => 'required | integer | max:15',
        'image' => 'required | image | max:1000'
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
        $this->gallery = new gallery();
    }

    public function gallery()
    {
        $this->validate();
        $gallery = gallery::query()->create([
            'product_id' => $this->product->id,
            'position' => $this->gallery->position,
        ]);
        if ($this->image) {
            $gallery->update([
                'img' => $this->images()
            ]);
        }

        $this->gallery->position = "";
        $this->image = null;

        $this->emit('toast', 'success', ' تصویر محصول با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن تصویر محصول' . ' :' . $gallery->product_id,
            'actionType' => 'ایجاد'
        ]);
    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "gallery/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function remove($removeId)
    {
        $gallery = gallery::find($removeId);
        $gallery->delete();
        $this->emit('toast', 'success', ' تصویر محصول با موفقیت حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کامل تصویر محصول' . ' :' . $gallery->product_id,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {

        $galleries = $this->readyToLoad ? gallery::where("product_id", $this->product->id)
            ->orderBy('position')->paginate(10) : [];
        return view('livewire.admin.product.gallery.product', compact('galleries'));
    }
}
