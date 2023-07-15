<?php

namespace App\Http\Livewire\Admin\Sms;

use App\Models\smsCode;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadSms()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $sms_code = $this->readyToLoad ? smsCode::where("user_id", "LIKE", "%{$this->search}%")
        ->orWhere("code", "LIKE", "%{$this->search}%")
        ->orWhere("id", "LIKE", "%{$this->search}%")
        ->latest()->paginate(20) : [];
        return view('livewire.admin.sms.index',compact('sms_code'));
    }
}
