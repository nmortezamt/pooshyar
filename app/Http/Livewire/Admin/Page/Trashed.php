<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\log;
use App\Models\page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $readyToLoad = false;
    public function loadPage()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $page = page::onlyTrashed()->find($removeId);
        if ($page->img) {
            Storage::disk('public')->delete("uploads", $page->img);
        }
        $page->forceDelete();
        $this->emit('toast', 'success', ' صفحه سایت به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه صفحه سایت حذف شد' . ' :' . $page->title,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorepage($id)
    {
        $page = page::withTrashed()->where('id', $id)->first();
        $page->restore();
        $this->emit('toast', 'success', ' صفحه سایت با موفقیت بازیابی شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی صفحه سایت' . ' :' . $page->title,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $pages = $this->readyToLoad ? DB::table('pages')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];
        return view('livewire.admin.page.trashed', compact('pages'));
    }
}
