<?php

namespace App\Http\Livewire\Admin\Footer\Title;

use App\Models\footerTitle;
use App\Models\log;
use Livewire\Component;

class Update extends Component
{
    public footerTitle $footerTitle;

    protected $rules = [
        'footerTitle.title' => 'required',

    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function title()
    {
        $this->validate();
        $this->footerTitle->update($this->validate());
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش عنوان فوتر سایت' . ' :' . $this->footerTitle->title,
            'actionType' => 'آپدیت'
        ]);

        return redirect(route('footer_title.index'));
    }

    public function render()
    {
        $footerTitles = $this->footerTitle;
        return view('livewire.admin.footer.title.update', compact('footerTitles'));
    }
}
