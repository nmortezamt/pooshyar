<?php

namespace App\Http\Livewire\Admin\Comment\Product;

use App\Models\commentProduct;
use App\Models\log;
use Livewire\Component;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;


    public function loadComment()
    {
        $this->readyToLoad = true;
    }

    public function updateCategorydisable($id)
    {
        $comment = commentProduct::find($id);
        $comment->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت کامنت با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن کامنت محصول' . ' :' . $comment->name,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $comment = commentProduct::find($id);
        $comment->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت کامنت با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن کامنت محصول' . " :" . $comment->name,
            'actionType' => 'فعال'
        ]);
    }
    public function remove($remove)
    {
        $comment = commentProduct::find($remove);
            $comment->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کامنت محصول' . ' :' . $comment->name,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' کامنت با موفقیت حذف شد');
    }

    public function render()
    {

        $comments = $this->readyToLoad ? commentProduct::where(function($query){
            $query->when($this->search ,function() use($query){
                $query->where("name", "LIKE", "%{$this->search}%")
                ->orWhere("email", "LIKE", "%{$this->search}%")
                ->orWhere("comment", "LIKE", "%{$this->search}%")
                ->orWhere("id", "{$this->search}");
            });
        })
        ->latest()->paginate(20) : [];
        return view('livewire.admin.comment.product.index',compact('comments'));
    }
}
