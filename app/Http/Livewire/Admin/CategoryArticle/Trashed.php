<?php

namespace App\Http\Livewire\Admin\CategoryArticle;

use App\Models\categoryArticle;
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

    public function remove($removeId)
    {
        $categories = categoryArticle::onlyTrashed()->find($removeId);
        if ($categories->img) {
            Storage::disk('public')->delete("uploads", $categories->img);
        }
        $categories->forceDelete();
        $this->emit('toast', 'success', ' دسته مقاله به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه دسته مقاله حذف شد' . ' :' . $categories->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $category = categoryArticle::withTrashed()->where('id', $id)->first();
        $category->restore();
        $this->emit('toast', 'success', ' دسته مقاله با موفقیت بازیابی شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی دسته مقاله' . ' :' . $category->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {
        $categories = $this->readyToLoad ? DB::table('categories')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.category-article.trashed',compact('categories'));
    }
}
