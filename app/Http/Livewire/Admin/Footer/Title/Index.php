<?php

namespace App\Http\Livewire\Admin\Footer\Title;

use App\Models\footerTitle;
use App\Models\log;
use Livewire\Component;

class Index extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public footerTitle $footerTitle;

    protected $rules = [
        'footerTitle.title' => 'required',

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
        $this->footerTitle = new footerTitle();
    }

    public function title()
    {
        $this->validate();
        if ($this->footerTitle->count() > 6) {
            $this->emit('toast', 'warning', ' عنوان فوتر نباید بیشتر از 7 تا باشد');
        } else {
            $footerTitle = footerTitle::query()->create([
                'title' => $this->footerTitle->title,
            ]);
            $this->footerTitle->title = "";
            $this->emit('toast', 'success', ' عنوان فوتر سایت با موفقیت اضافه شد');

            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن عنوان به فوتر سایت' . ' :' . $footerTitle->title,
                'actionType' => 'ایجاد'
            ]);
        }
    }

    public function render()
    {
        $footerTitles = $this->readyToLoad ? footerTitle::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.footer.title.index', compact('footerTitles'));
    }
}
