<?php

namespace App\Http\Livewire\Admin\Header\Menu;

use App\Models\log;
use App\Models\SiteHeader;
use Livewire\Component;

class Index extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public SiteHeader $menu;
    protected $rules = [
        'menu.title' => 'required | min:2 | max:20',
        'menu.link' => 'required | max:30',
        'menu.status' => 'nullable',
    ];
    public function loadHeader()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->menu = new SiteHeader();
    }

    public function menu()
    {
        $this->validate();
        if($this->menu->count() > 6){
        $this->emit('toast', 'warning', ' نمی توانید بیش از 7 تا منو ایجاد کنید');
        }else{
            $menu = SiteHeader::query()->create([
            'title' => $this->menu->title,
            'link' => $this->menu->link,
            'status' => $this->menu->status ? 1 : 0,
        ]);
        $this->emit('toast', 'success', ' دسته با موفقیت اضافه شد');
        $this->menu->title = "";
        $this->menu->link = "";
        $this->menu->status = false;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن منو سایت' . ' :' . $menu->title,
            'actionType' => 'ایجاد'
        ]);
        }

    }

    public function updateCategorydisable($id)
    {
        $menu = SiteHeader::find($id);
        $menu->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت منو با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن منو' . ' :' . $menu->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $menu = SiteHeader::find($id);
        $menu->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت منو با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن منو' . " :" . $menu->title,
            'actionType' => 'فعال'
        ]);
    }

    public function render()
    {

        $menus = $this->readyToLoad ? SiteHeader::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.header.menu.index',compact('menus'));
    }
}
