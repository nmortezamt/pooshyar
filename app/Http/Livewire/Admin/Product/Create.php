<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\log;
use App\Models\priceDate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Product\Product\Models\product;

class Create extends Component
{
    use WithFileUploads;
    public $image;
    public $body;
    public $description;
    public product $product;

    protected $rules = [
        'product.title' => 'required | min:3 | max:50',
        'product.category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.brand_id' => 'nullable',
        'description' => 'required | max:500',
        'product.description_seo' => 'required | min:20 | max:400',
        'body' => 'required | min:20',
        'product.number' => 'required | integer | max:900000',
        'product.price' => 'required | integer | max:90000000',
        'product.price_major' => 'required | integer | max:90000000',
        'product.discount_price' => 'nullable | integer | max:90000000',
        'product.time' => 'required | max:2',
        'product.shipment' => 'nullable',
        'product.status' => 'nullable',
        'product.publish' => 'nullable',
        'product.order_count' => 'nullable | integer | max:1000',
        'image' => 'required | image | max:1000',

    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->product = new product();
    }

    public function product()
    {
        $this->validate();

        $product = product::query()->create([
            'title' =>$this->product->title,
            'category_id' =>$this->product->category_id,
            'subcategory_id' =>$this->product->subcategory_id,
            'brand_id' =>$this->product->brand_id,
            'body' =>$this->body,
            'description' =>$this->description,
            'description_seo' =>$this->product->description_seo,
            'price' =>$this->product->price,
            'price_major' =>$this->product->price_major,
            'discount_price' =>$this->product->discount_price,
            'number' =>$this->product->number,
            'time' =>$this->product->time,
            'shipment' =>$this->product->shipment ? 1 : 0,
            'publish' =>$this->product->publish ? 1:0,
            'order_count' =>$this->product->order_count,
            'status' =>$this->product->status ? 1:0,
        ]);

        $price_date = priceDate::query()->create([
            'product_id'=>$product->id,
            'price'=>$product->price,
            'discount_price'=>$product->discount_price ?? null,
        ]);

        if($this->image){
            $product->update([
                'img'=>$this->images()
            ]);
        }
        alert()->success('موفقیت', 'محصول با موفقیت ایجاد شد')->showConfirmButton('باشه', '#3085d6');

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن محصول' . ' :' . $product->title,
            'actionType' => 'ایجاد'
        ]);
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
        return view('livewire.admin.product.create');
    }
}
