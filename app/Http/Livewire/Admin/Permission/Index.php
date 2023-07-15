<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Models\log;
use App\Models\permission;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public permission $permission;
    protected $rules = [
        'permission.name' => 'required | max:30',
        'permission.description' => 'required | max:60',
    ];
    public function loadPermission()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->permission = new permission();
    }

    public function permission()
    {
        $this->validate();
        $permission = permission::query()->create([
            'name' => $this->permission->name,
            'description' => $this->permission->description,
        ]);
        $this->emit('toast', 'success', ' دسترسی با موفقیت اضافه شد');
        $this->permission->name = "";
        $this->permission->description = "";

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن دسترسی' . ' :' . $permission->name,
            'actionType' => 'ایجاد'
        ]);
    }


    public function remove($remove)
    {
        $permission = permission::find($remove);
            $permission->delete();
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف دسترسی' . ' :' . $permission->name,
                'actionType' => 'حذف'
            ]);
            $this->emit('toast', 'success', ' دسترسی با موفقیت حذف شد');

    }

    public function render()
    {

        $permissions = $this->readyToLoad ? permission::where("name", "LIKE", "%{$this->search}%")
            ->orWhere("description", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.permission.index',compact('permissions'));
    }
}
