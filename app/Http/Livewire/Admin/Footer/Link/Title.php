<?php

namespace App\Http\Livewire\Admin\Footer\Link;

use App\Models\FooterlinkTitle;
use App\Models\log;
use Livewire\Component;

class Title extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public FooterlinkTitle $FooterlinkTitle;

    protected $rules = [
        'FooterlinkTitle.page_id' => 'required',

    ];
    public function loadTitle()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->FooterlinkTitle = new FooterlinkTitle();
    }

    public function title()
    {
        $footer = FooterlinkTitle::where('page_id',$this->FooterlinkTitle->page_id)->first();
        $this->validate();
        if ($this->FooterlinkTitle->count() > 3) {
            $this->emit('toast', 'warning', ' عنوان فوتر سایت نباید بیشتر از 4 تا باشد');
        } elseif($footer) {
            $this->emit('toast', 'warning', 'قبلا این عنوان فوتر را ثبت کردید');
        }else{
            $FooterlinkTitle = FooterlinkTitle::query()->create([
                'page_id' => $this->FooterlinkTitle->page_id,
            ]);
            $this->FooterlinkTitle->page_id = null;
            $this->emit('toast', 'success', ' عنوان فوتر سایت با موفقیت اضافه شد');
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن عنوان به فوتر سایت' . ' :' . $FooterlinkTitle->page->title,
                'actionType' => 'ایجاد'
            ]);
        }
    }


    public function remove($removeId)
    {
        $FooterlinkTitle = FooterlinkTitle::find($removeId);
        $FooterlinkTitle->delete();
        $this->emit('toast', 'success', ' عنوان فوتر با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' حذف عنوان فوتر' . ' :' . $FooterlinkTitle->page->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $FooterlinkTitles = $this->readyToLoad ? FooterlinkTitle::where("page_id", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.footer.link.title', compact('FooterlinkTitles'));
    }
}
