<?php

namespace App\Http\Livewire\Admin\Header\Logo;

use App\Models\log;
use App\Models\logoSite;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $image;
    public $readyToLoad = false;

    public logoSite $logo;
    protected $rules = [
        'image' => 'required | image | max:1000'
    ];
    public function loadLogo()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->logo = new logoSite();
    }

    public function logo()
    {
        $this->validate();
        if($this->logo->count()>0){
            $this->emit('toast', 'warning', ' نمی توانید بیشتر از یک لوگو اضافه کنید');
        }else{
        $logo = logoSite::query()->create([
            'img' => $this->images()
            ]);
        $this->emit('toast', 'success', ' لوگو سایت با موفقیت اضافه شد');
        $this->image = null;

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن لوگو' . ' :' . $logo->id,
            'actionType' => 'ایجاد'
        ]);
    }
    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "logo/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {

        $logoSite = $this->readyToLoad ? logoSite::latest()->get() : [];
        return view('livewire.admin.header.logo.index',compact('logoSite'));
    }
}
