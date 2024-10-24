<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Models\User;

class NotConfirm extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function confirmUser($id)
    {
        $user = User::find($id);
        $user->update([
            'email_verified_at' => now()
        ]);
        $this->emit('toast', 'success', 'ایمیل کاربر با موفقیت تایید شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'تایید کردن ایمیل کاربر' . ' :' . $user->name,
            'actionType' => 'فعال'
        ]);
    }

    public function remove($remove)
    {
        $user = user::find($remove);
        $user->delete();
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کاربر' . ' :' . $user->name,
            'actionType' => 'حذف'
        ]);
        $this->emit('toast', 'success', ' کاربر با موفقیت حذف شد');
    }

    public function render()
    {
        $users =$this->readyToLoad ? User::whereNull("email_verified_at")->where(function($query){
            $query->when($this->search , function() use($query){
                $query->orWhere('name','LIKE',"%{$this->search}%")->get();
                $query->orWhere('email','LIKE',"%{$this->search}%")->get();
                $query->orWhere('number','LIKE',"%{$this->search}%")->get();
            });
        })
        ->latest()->paginate(20) : [];
        return view('livewire.admin.users.not-confirm',compact('users'));
    }
}
