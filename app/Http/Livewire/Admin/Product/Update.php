<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\cart;
use App\Models\log;
use App\Models\priceDate;
use App\Models\product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public product $product;
    protected $rules = [
        'product.title' => 'required | min:3 | max:50',
        'product.link' => 'required | min:3 | max:60',
        'product.category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.brand_id' => 'nullable',
        'product.description' => 'required | max:500',
        'product.description_seo' => 'required | min:20 | max:400',
        'product.body' => 'required | min:20 ',
        'product.number' => 'required | integer | max:900000',
        'product.time' => 'required | max:20',
        'product.price' => 'required | integer | max:90000000',
        'product.price_major' => 'required | integer | max:90000000',
        'product.discount_price' => 'nullable | max:90000000',
        'product.shipment' => 'nullable',
        'product.status' => 'nullable',
        'product.publish' => 'nullable',
        'product.order_count' => 'nullable | integer | max:10000',
        'image' => 'nullable | image | max:1000',

    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function product()
    {
        $this->validate();
        $link = $this->product->link;
        $this->product->link = str_replace(' ','-',$link);

        if ($this->image) {
            Storage::disk('public')->delete('uploads',$this->product->img);
            $this->product->img = $this->images();
        }
        $this->product->update($this->validate());
        if (!$this->product->status) {
            $this->product->update(['status' => 0]);
        }
        if(!$this->product->shipment){
            $carts = cart::where('product_id',$this->product->id)->get();
        foreach($carts as $cart){
            $cart->delete();
        }
        
        }
        $carts = cart::where('product_id',$this->product->id)->get();
        foreach($carts as $cart){
            $cart->update([
                'product_price'=>$this->product->price,
                'product_price_discount' => $this->product->discount_price ? $this->product->price/100*(100-$this->product->discount_price) : null,
                'total_price' =>$this->product->discount_price ? $cart->count * $this->product->price/100*(100-$this->product->discount_price) : $cart->count * $this->product->price,

            ]);
        }
        $price_date = priceDate::query()->create([
            'product_id'=>$this->product->id,
            'price'=>$this->product->price,
            'discount_price'=>$this->product->discount_price ?? null,
        ]);
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش محصول' . ' :' . $this->product->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'محصول با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');

        return redirect(route('product.index'));
    }
    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "product/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }


    public function render()
    {
        if ($this->product->status == 1) {
            $this->product->status = true;
        } else {
            $this->product->status = false;
        }
        if ($this->product->publish == 1) {
            $this->product->publish = true;
        } else {
            $this->product->publish = false;
        }
        if ($this->product->shipment == 1) {
            $this->product->shipment = true;
        } else {
            $this->product->shipment = false;
        }

        $products = $this->product;
        return view('livewire.admin.product.update', compact('products'));
    }
}
