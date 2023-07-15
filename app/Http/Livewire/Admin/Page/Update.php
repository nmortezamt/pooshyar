<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\log;
use App\Models\page;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public page $page;
    protected $rules = [
        'page.title' => 'required | max:40',
        'page.link' => 'required | max:40',
        'image' => 'nullable | image | max:1000',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function page()
    {
        $this->validate();
        if ($this->image) {
            if ($this->page->img) {
                Storage::disk('public')->delete('uploads', $this->page->img);
            }
            $this->page->img = $this->images();
        }
        $this->page->update($this->validate());
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش صفحه سایت' . ' ' . $this->page->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'صفحه سایت با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('page.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "page/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        $pages = $this->page;

        return view('livewire.admin.page.update', compact('pages'));
    }
}
