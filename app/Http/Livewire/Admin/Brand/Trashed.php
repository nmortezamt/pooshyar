<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\brand;
use App\Models\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $brand = brand::onlyTrashed()->find($removeId);
        if($brand->img){
            Storage::disk('public')->delete("uoloads", $brand->img);
        }
        $brand->forceDelete();
        $this->emit('toast', 'success', ' برند به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه برند حذف شد' . ' :' . $brand->name,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $brand = brand::withTrashed()->where('id', $id)->first();
        $brand->restore();
        $this->emit('toast', 'success', ' برند با موفقیت بازیابی شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی برند' . ' :' . $brand->name,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $brands = $this->readyToLoad ? DB::table('brands')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.brand.trashed', compact('brands'));
    }
}
