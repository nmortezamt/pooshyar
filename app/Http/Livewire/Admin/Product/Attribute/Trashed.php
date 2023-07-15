<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\attribute;
use App\Models\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
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

    public function remove($id)
    {
        $attribute = attribute::onlyTrashed()->find($id);
        $attribute->forceDelete();
        $this->emit('toast', 'success', '  مشخصات کالا به صورت کامل از دیتابیس حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه مشخصات کالا حذف شد' . ' :' . $attribute->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $attribute = attribute::withTrashed()->where('id', $id)->first();
        $attribute->restore();
        $this->emit('toast', 'success', '  مشخصات کالا با موفقیت بازیابی شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی مشخصات کالا' . ' :' . $attribute->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $attributes = $this->readyToLoad ? DB::table('attributes')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.product.attribute.trashed', compact('attributes'));
    }
}
