<?php

namespace App\Http\Livewire\Admin\SearchHistory;

use App\Models\searchHistory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadSearch()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $search_histories = $this->readyToLoad ? searchHistory::where("user_id", "LIKE", "%{$this->search}%")
        ->orWhere("text_search", "LIKE", "%{$this->search}%")
        ->orWhere("id", "LIKE", "%{$this->search}%")
        ->latest()->paginate(20) : [];
        return view('livewire.admin.search-history.index',compact('search_histories'));
    }
}
