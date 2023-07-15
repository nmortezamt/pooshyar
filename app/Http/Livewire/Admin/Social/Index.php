<?php

namespace App\Http\Livewire\Admin\Social;

use App\Models\log;
use App\Models\social;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;

    public social $social;

    protected $rules = [
        'social.title' => 'required | max:20',
        'social.type' => 'required',
        'social.link' => 'required | max:60',
    ];
    public function loadSocial()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->social = new social();
    }

    public function social()
    {
        $this->validate();
        $social = social::query()->create([
            'title' => $this->social->title,
            'type' => $this->social->type,
            'link' => $this->social->link,
        ]);

        $this->social->title = "";
        $this->social->type = null;
        $this->social->link = "";

        $this->emit('toast', 'success', ' شبکه اجتماعی با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن شبکه اجتماعی' . ' :' . $social->title,
            'actionType' => 'ایجاد'
        ]);
    }

    public function remove($removeId)
    {
        $social = social::find($removeId);
        $social->delete();
        $this->emit('toast', 'success', ' شبکه اجتماعی با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف شبکه اجتماعی' . ' :' . $social->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $socials = $this->readyToLoad ? social::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("link", "LIKE", "{$this->search}")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(20) : [];
        return view('livewire.admin.social.index', compact('socials'));
    }
}
