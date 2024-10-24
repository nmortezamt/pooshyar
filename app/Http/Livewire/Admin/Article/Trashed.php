<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Blog\Models\blog;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadArticle()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $article = blog::onlyTrashed()->find($removeId);
        Storage::disk('public')->delete("uploads", $article->img);
        $article->forceDelete();
        $this->emit('toast', 'success', ' مقاله به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه مقاله حذف شد' . ' :' . $article->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorearticle($id)
    {
        $article = blog::withTrashed()->where('id', $id)->first();
        $article->restore();
        $this->emit('toast', 'success', ' مقاله با موفقیت بازیابی شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی مقاله' . ' :' . $article->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {
        $articles = $this->readyToLoad ? DB::table('articles')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.article.trashed', compact('articles'));
    }
}
