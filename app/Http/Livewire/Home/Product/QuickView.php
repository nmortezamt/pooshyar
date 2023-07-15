<?php

namespace App\Http\Livewire\Home\Product;

use App\Models\category;
use App\Models\commentProduct;
use App\Models\favorite;
use App\Models\gallery;
use App\Models\product;
use Livewire\Component;

class QuickView extends Component
{
    public product $product;
    public commentProduct $comment;

    public function mount(product $id)
    {
        $this->product = $id;

    }

    public function render()
    {
        $product = $this->product;
        $galleries = gallery::where('product_id', $this->product->id)->orderBy('position')->get();
        $category = category::where('id', $this->product->category_id)->first();
        $countComment = commentProduct::where('product_id',$product->id)->where('status',1)->count();
        $sum = commentProduct::where('product_id',$product->id)->where('status',1)->sum('rate');
        if($countComment !=null){
        $rating = $sum / $countComment;
        }else{
            $rating = 0;
        }
        return view('livewire.home.product.quick-view',compact('product','galleries','category','countComment','rating'))->layout('layouts.product');
    }
}
