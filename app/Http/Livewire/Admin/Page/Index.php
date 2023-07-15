<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\log;
use App\Models\page;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $image;
    public $search;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;

    public page $page_site;

    protected $rules = [
        'page_site.title' => 'required',
        'page_site.link' => 'required',
        'image' => 'nullable | image | max:1000',

    ];
    public function loadPage()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->page_site = new page();
    }

    public function page()
    {
        $this->validate();

        $page = page::query()->create([
            'title' => $this->page_site->title,
            'link' => $this->page_site->link,

        ]);

        if ($this->image) {
            $page->update([
                'img' => $this->images()
            ]);
        }

        $this->page_site->title = "";
        $this->page_site->link = "";
        $this->image = null;

        $this->emit('toast', 'success', ' صفحه با موفقیت اضافه شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن صفحه' . ' :' . $page->title,
            'actionType' => 'ایجاد'
        ]);
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

    public function remove($removeId)
    {
        $page = page::find($removeId);
        $page->delete();
        $this->emit('toast', 'success', ' صفحه با موفقیت حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف صفحه' . ' :' . $page->title,
            'actionType' => 'حذف'
        ]);
    }

    public function render()
    {
        $pages = $this->readyToLoad ? page::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("link", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(20) : [];
        return view('livewire.admin.page.index', compact('pages'));
    }
}
