<?php

namespace App\Http\Livewire\Admin\Product\Color;

use App\Models\color;
use App\Models\log;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function remove($removeId)
    {
        $color = color::onlyTrashed()->find($removeId);
        $color->forceDelete();
        $this->emit('toast', 'success', ' رنگ به صورت کامل از دیتابیس حذف شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'برای همیشه رنگ حذف شد' . ' :' . $color->name,
            'actionType' => 'حذف کامل'
        ]);
    }

    public function restorecategory($id)
    {
        $color = color::withTrashed()->where('id', $id)->first();
        $color->restore();
        $this->emit('toast', 'success', ' رنگ با موفقیت بازیابی شد');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => ' بازیابی رنگ' . ' :' . $color->name,
            'actionType' => 'بازیابی'
        ]);
    }

    public function render()
    {

        $colors = $this->readyToLoad ? DB::table('colors')->whereNotNull('deleted_at')
            ->latest()->paginate(10) : [];

        return view('livewire.admin.product.color.trashed', compact('colors'));
    }
}
