<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Models\log;
use App\Models\permission;
use Livewire\Component;

class Update extends Component
{

    public permission $permission;
    protected $rules = [
        'permission.name' => 'required | max:30',
        'permission.description' => 'required | max:60',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function permission()
    {
        $this->validate();
        $this->permission->update($this->validate());
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش دسترسی' . ' ' . $this->permission->name,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'دسترسی با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('permission.index'));
    }

    public function render()
    {

        $permission = $this->permission;
        return view('livewire.admin.permission.update',compact('permission'));
    }
}
