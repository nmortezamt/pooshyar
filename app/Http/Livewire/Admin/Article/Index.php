<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Blog\Models\blog;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadArticle()
    {
        $this->readyToLoad = true;
    }

    public function updateArticledisable($id)
    {
        $article = blog::find($id);
        $article->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت مقاله با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن مقاله' . ' :' . $article->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateArticleinable($id)
    {
        $article = blog::find($id);
        $article->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت مقاله با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن مقاله' . " :" . $article->title,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $article = blog::find($remove);
        $article->delete();
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف مقاله' . ' :' . $article->title,
            'actionType' => 'حذف'
        ]);
        $this->emit('toast', 'success', ' مقاله با موفقیت حذف شد');
    }

    public function render()
    {
        $articles = $this->readyToLoad ? blog::where("title", "LIKE", "%{$this->search}%")
        ->orWhere("keyword", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(10) : [];

        return view('livewire.admin.article.index',compact('articles'));
    }
}
