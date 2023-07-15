<?php

namespace App\Http\Livewire\Admin\Favorite;

use App\Models\favorite;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadFavorite()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $favorites = $this->readyToLoad ? favorite::where("user_id", "LIKE", "%{$this->search}%")
        ->orWhere("product_id", "LIKE", "%{$this->search}%")
        ->orWhere("id", "LIKE", "%{$this->search}%")
        ->latest()->paginate(20) : [];
        return view('livewire.admin.favorite.index',compact('favorites'));
    }
}
