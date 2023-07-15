<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\log;
use App\Models\subcategory;
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


    public function remove($removeId)
    {
        $subcategory = subcategory::onlyTrashed()->find($removeId);
        if($subcategory->img){
         Storage::disk('public')->delete("uploads", $subcategory->img);
        }
        $subcategory->forceDelete();
        $this->emit('toast', 'success', ' زیر دسته به صورت کامل از دیتابیس حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه زیر دسته حذف شد' . ' :' . $subcategory->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $subcategory = subcategory::withTrashed()->where('id', $id)->first();
        $subcategory->restore();
        $this->emit('toast', 'success', ' زیر دسته با موفقیت بازیابی شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی زیر دسته' . ' :' . $subcategory->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $subcategories = $this->readyToLoad ? DB::table('subcategories')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.subcategory.trashed', compact('subcategories'));
    }
}
