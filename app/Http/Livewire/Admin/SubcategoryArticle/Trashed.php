<?php

namespace App\Http\Livewire\Admin\SubcategoryArticle;

use App\Models\log;
use App\Models\subcategoryArticle;
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
        $subcategory = subcategoryArticle::onlyTrashed()->find($removeId);
        if($subcategory->img){
         Storage::disk('public')->delete("uploads", $subcategory->img);
        }
        $subcategory->forceDelete();
        $this->emit('toast', 'success', ' زیر دسته مقاله به صورت کامل از دیتابیس حذف شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه زیر دسته مقاله حذف شد' . ' :' . $subcategory->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $subcategory = subcategoryArticle::withTrashed()->where('id', $id)->first();
        $subcategory->restore();
        $this->emit('toast', 'success', ' زیر دسته مقاله با موفقیت بازیابی شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی زیر دسته مقاله' . ' :' . $subcategory->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $subcategories = $this->readyToLoad ? DB::table('subcategories')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.subcategory-article.trashed',compact('subcategories'));
    }
}
