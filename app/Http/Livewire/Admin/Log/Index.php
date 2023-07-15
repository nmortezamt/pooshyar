<?php

namespace App\Http\Livewire\Admin\Log;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $search;
    protected $queryString=['search'];
    public $readyToLoad = false;


    public function loadCategory()
    {
        $this->readyToLoad =true;
    }

    public function render()
    {

        $logs = $this->readyToLoad ? log::where("actionType","LIKE","%{$this->search}%")
        ->orWhere("user_id","LIKE","%{$this->search}%")
        ->orWhere("url","LIKE","%{$this->search}%")
        ->orWhere("id","{$this->search}")
        ->latest()->paginate(20) : [];
        return view('livewire.admin.log.index',compact('logs'));
    }
}
