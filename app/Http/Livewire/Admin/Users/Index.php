<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\log;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Models\User;

class Index extends Component
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
        $user_confirm = User::whereNotNull('email_verified_at')->count();
        $user_not_confirm = User::whereNull('email_verified_at')->count();
        $users = $this->readyToLoad ? user::where("name", "LIKE", "%{$this->search}%")
        ->orWhere("email", "LIKE", "%{$this->search}%")
        ->orWhere("number", "LIKE", "%{$this->search}%")
        ->orWhere("id", "{$this->search}")
        ->latest()->paginate(20) : [];

        return view('livewire.admin.users.index',compact('users','user_confirm','user_not_confirm'));
    }
}
