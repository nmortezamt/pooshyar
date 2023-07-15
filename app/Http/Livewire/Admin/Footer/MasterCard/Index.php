<?php

namespace App\Http\Livewire\Admin\Footer\MasterCard;

use App\Models\log;
use App\Models\master_card;
use Livewire\Component;

class Index extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public master_card $master_card;

    protected $rules = [
        'master_card.page_id' => 'required',
    ];
    public function loadMaster()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->master_card = new master_card();
    }

    public function master()
    {
        $this->validate();
        if ($this->master_card->count() > 1) {
            $this->emit('toast', 'warning', ' تصویر فوتر سایت نباید بیشتر از 2 تا باشد');
        } else {
            $master_card = master_card::query()->create([
                'page_id' => $this->master_card->page_id,
            ]);

            $this->master_card->page_id = "";

            $this->emit('toast', 'success', ' تصویر به فوتر سایت با موفقیت اضافه شد');

            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن تصویر به فوتر سایت' . ' :' . $master_card->page_id,
                'actionType' => 'ایجاد'
            ]);
        }
    }


    public function remove($removeId)
    {
        $master_card = master_card::find($removeId);
        $master_card->delete();
        $this->emit('toast', 'success', ' تصویر فوتر سایت با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' حذف تصویر فوتر سایت' . ' :' . $master_card->page_id,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $masterCards = $this->readyToLoad ? master_card::where("page_id", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->get() : [];
        return view('livewire.admin.footer.master-card.index', compact('masterCards'));
    }
}
