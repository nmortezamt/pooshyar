<?php

namespace App\Http\Livewire\Admin\Footer\Link;

use App\Models\FooterlinkTitle;
use App\Models\log;
use Livewire\Component;

class UpdateTitle extends Component
{
    public FooterlinkTitle $footer;

    protected $rules = [
        'footer.page_id' => 'required',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function title()
    {
        $this->validate();
        $footer = FooterlinkTitle::where('page_id', $this->footer->page_id)->first();
        if ($footer) {
            $this->emit('toast', 'warning', 'قبلا این عنوان فوتر را ثبت کردید');
        } else {
            $this->footer->update($this->validate());
            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش عنوان فوتر صفحه سایت' . ' :' . $this->footer->page_id,
                'actionType' => 'آپدیت'
            ]);
            alert()->success('موفقیت', 'عنوان فوتر لینک با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
            return redirect(route('title.index'));
        }
    }

    public function render()
    {
        $footer = $this->footer;
        return view('livewire.admin.footer.link.update-title', compact('footer'));
    }
}
