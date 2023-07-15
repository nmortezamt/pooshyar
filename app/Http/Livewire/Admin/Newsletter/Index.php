<?php

namespace App\Http\Livewire\Admin\Newsletter;

use App\Models\log;
use App\Models\newletter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;

    public newletter $newletter;

    protected $rules = [
        'newletter.email' => 'required | email | max:60',
    ];
    public function loadNewLatter()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->newletter = new newletter();
    }

    public function newLatter()
    {
        $this->validate();
        $newletter = newletter::query()->create([
            'email' => $this->newletter->email,
        ]);
        $this->newletter->email = "";

        $this->emit('toast', 'success', ' خبرنامه با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن خبرنامه' . ' :' . $newletter->email,
            'actionType' => 'ایجاد'
        ]);
    }

    public function remove($removeId)
    {
        $newletter = newletter::find($removeId);
        $newletter->delete();
        $this->emit('toast', 'success', ' خبرنامه با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف خبرنامه' . ' :' . $newletter->email,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $newletters = $this->readyToLoad ? newletter::where("email", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(20) : [];
        return view('livewire.admin.newsletter.index', compact('newletters'));
    }
}
