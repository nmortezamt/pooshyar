<?php

namespace App\Http\Livewire\Admin\Footer\Link;

use App\Models\FooterlinkTwo;
use App\Models\log;
use Livewire\Component;

class Two extends Component
{

    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public FooterlinkTwo $FooterlinkTwo;

    protected $rules = [
        'FooterlinkTwo.page_id' => 'required',
    ];
    public function loadTwo()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->FooterlinkTwo = new FooterlinkTwo();
    }

    public function two()
    {
        $this->validate();
        $footer = FooterlinkTwo::where('page_id', $this->FooterlinkTwo->page_id)->first();
        if ($footer) {
        $this->emit('toast', 'warning', ' قبلا این صفحه فوتر را ثبت کرده اید');
        } else {
            $FooterlinkTwo = FooterlinkTwo::query()->create([
                'page_id' => $this->FooterlinkTwo->page_id,
            ]);
            $this->FooterlinkTwo->page_id = "";

            $this->emit('toast', 'success', ' صفحه به فوتر سایت با موفقیت اضافه شد');

            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن صفحه به فوتر سایت' . ' :' . $FooterlinkTwo->page_id,
                'actionType' => 'ایجاد'
            ]);
        }

    }


    public function remove($removeId)
    {
        $FooterlinkTwo = FooterlinkTwo::find($removeId);
        $FooterlinkTwo->delete();
        $this->emit('toast', 'success', ' صفحه فوتر سایت با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' حذف صفحه فوتر سایت' . ' :' . $FooterlinkTwo->page_id,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $FooterlinkTwos = $this->readyToLoad ? FooterlinkTwo::where("page_id", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.footer.link.two', compact('FooterlinkTwos'));
    }
}
