<?php

namespace App\Http\Livewire\Admin\Header\Menu;

use App\Models\log;
use App\Models\SiteHeader;
use Livewire\Component;

class Update extends Component
{
    public SiteHeader $menu;
    protected $rules = [
        'menu.title' => 'required | min:2 | max:20',
        'menu.link' => 'required | max:30',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function menu()
    {
        $this->validate();
        $this->menu->update($this->validate());
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش دسته' . ' ' . $this->menu->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'منو سایت با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('header.index'));
    }

    public function render()
    {
        $menu = $this->menu;
        return view('livewire.admin.header.menu.update',compact('menu'));
    }
}
