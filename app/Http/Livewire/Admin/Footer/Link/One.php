<?php

namespace App\Http\Livewire\Admin\Footer\Link;

use App\Models\FooterlinkOne;
use App\Models\log;
use Livewire\Component;

class One extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;
    public FooterlinkOne $FooterlinkOne;
    protected $rules = [
        'FooterlinkOne.page_id' => 'required',
    ];
    public function loadOne()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->FooterlinkOne = new FooterlinkOne();
    }

    public function one()
    {
        $this->validate();
        $footer = FooterlinkOne::where('page_id', $this->FooterlinkOne->page_id)->first();
        if ($footer) {
        $this->emit('toast', 'warning', ' قبلا این صفحه فوتر را ثبت کرده اید');
        }else{
            $FooterlinkOne = FooterlinkOne::query()->create([
                'page_id' => $this->FooterlinkOne->page_id,
            ]);
            $this->FooterlinkOne->page_id = "";
            $this->emit('toast', 'success', ' صفحه به فوتر سایت با موفقیت اضافه شد');

            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن صفحه به فوتر سایت' . ' :' . $FooterlinkOne->page_id,
                'actionType' => 'ایجاد'
            ]);
        }

    }


    public function remove($removeId)
    {
        $FooterlinkOne = FooterlinkOne::find($removeId);
        $FooterlinkOne->delete();
        $this->emit('toast', 'success', ' صفحه فوتر سایت با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' حذف صفحه فوتر سایت' . ' :' . $FooterlinkOne->page_id,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $FooterlinkOnes = $this->readyToLoad ? FooterlinkOne::where("page_id", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.footer.link.one', compact('FooterlinkOnes'));
    }
}
