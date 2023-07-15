<?php

namespace App\Http\Livewire\Admin\Product\Attributevalue;

use App\Models\attributeValue;
use App\Models\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    protected $queryString=['search'];
    public $readyToLoad = false;


    public function loadCategory()
    {
        $this->readyToLoad =true;
    }


public function remove($id)
{
   $attributeValue = attributeValue::onlyTrashed()->find($id);
    $attributeValue->forceDelete();
    $this->emit('toast' ,'success' ,'  مقدار مشخصه کالا به صورت کامل از دیتابیس حذف شد');
    log::create([
        'user_id'=> auth()->user()->id,
        'url'=> 'برای همیشه مقدار مشخصه کالا حذف شد' .' :'. $attributeValue->product_id,
        'actionType'=> 'حذف کامل'
    ]);
}

public function restorecategory($id)
{
    $attributeValue = attributeValue::withTrashed()->where('id',$id)->first();
    $attributeValue->restore();
    $this->emit('toast' ,'success' ,'  مقدار مشخصه کالا با موفقیت بازیابی شد');
    log::create([
        'user_id'=> auth()->user()->id,
        'url'=> ' بازیابی مقدار مشخصه کالا' .' :'. $attributeValue->product_id,
        'actionType'=> 'بازیابی'
    ]);
}

    public function render()
    {

        $attributeValues = $this->readyToLoad ? DB::table('attribute_values')->whereNotNull('deleted_at')
        ->latest()->paginate(10) : [];
        return view('livewire.admin.product.attributevalue.trashed',compact('attributeValues'));
    }
}
