<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\log;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString=['search'];
    public $readyToLoad = false;

    public function loadCategory()
    {
        $this->readyToLoad =true;
    }

public function remove($removeId)
{
    $product = product::onlyTrashed()->find($removeId);
    Storage::disk('public')->delete("uploads",$product->img);
    $product->forceDelete();
    $this->emit('toast' ,'success' ,' محصول به صورت کامل از دیتابیس حذف شد');

    log::create([
        'user_id'=> auth()->user()->id,
        'url'=> 'برای همیشه محصول حذف شد' .' :'. $product->title,
        'actionType'=> 'حذف کامل'
    ]);
}

public function restorecategory($id)
{
    $product = product::withTrashed()->where('id',$id)->first();
    $product->restore();
    $this->emit('toast' ,'success' ,' محصول با موفقیت بازیابی شد');

    log::create([
        'user_id'=> auth()->user()->id,
        'url'=> ' بازیابی محصول' .' :'. $product->title,
        'actionType'=> 'بازیابی'
    ]);
}

    public function render()
    {
        $products = $this->readyToLoad ? DB::table('products')->whereNotNull('deleted_at')
        ->latest()->paginate(10) : [];
        return view('livewire.admin.product.trashed',compact('products'));
    }
}
