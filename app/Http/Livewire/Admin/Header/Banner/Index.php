<?php

namespace App\Http\Livewire\Admin\Header\Banner;

use App\Models\log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Banner\Models\Banner;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;

    public Banner $banner;
    protected $rules = [
        'banner.title' => 'required | min:3 | max:50',
        'banner.link' => 'required | max:100',
        'banner.description' => 'required | max:100',
        'banner.status' => 'nullable',
        'image' => 'required | image | max:1000'
    ];
    public function loadBanner()
    {
        $this->readyToLoad = true;
    }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->banner = new Banner();
    }

    public function banner()
    {
        $this->validate();
        if($this->banner->count() > 4){
            $this->emit('toast', 'warning', ' نمی توانید بیشتر از 5 تا بنر ثبت کنید');
        }else{
            $banner = Banner::query()->create([
                'title' => $this->banner->title,
                'link' => $this->banner->link,
                'description' => $this->banner->description,
                'status' => $this->banner->status ? 1 : 0,
            ]);
            if ($this->image) {
                $banner->update([
                    'img' => $this->images()
                ]);
            }
            $this->emit('toast', 'success', ' بنر با موفقیت اضافه شد');
            $this->banner->title = "";
            $this->banner->link = "";
            $this->banner->description = "";
            $this->banner->status = false;
            $this->image = null;

            log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن بنر سایت' . ' :' . $banner->title,
                'actionType' => 'ایجاد'
            ]);
        }

    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "banner/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function updateCategorydisable($id)
    {
        $banner = Banner::find($id);
        $banner->update([
            'status' => 0
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت غیر فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'غیر فعال کردن بنر' . ' :' . $banner->title,
            'actionType' => 'غیر فعال'
        ]);
    }
    public function updateCategoryinable($id)
    {
        $banner = Banner::find($id);
        $banner->update([
            'status' => 1
        ]);
        $this->emit('toast', 'success', 'وضیعت بنر با موفقیت فعال شد');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'فعال کردن بنر' . " :" . $banner->title,
            'actionType' => 'فعال'
        ]);
    }

    public function render()
    {

        $banners = $this->readyToLoad ? Banner::where("title", "LIKE", "%{$this->search}%")
            ->orWhere("id", "{$this->search}")
            ->latest()->paginate(10) : [];
        return view('livewire.admin.header.banner.index',compact('banners'));
    }
}
