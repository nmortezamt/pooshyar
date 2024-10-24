<?php

namespace App\Http\Livewire\Home\Product;

use App\Models\cart;
use App\Models\favorite;
use App\Models\productColorOrder;
use App\Models\productSizeOrder;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\Category\Models\category as ModelsCategory;
use Modules\Product\Product\Models\product;

class Category extends Component
{
    public $selected = [
        'category' => [],
        'size' => [],
        'color' => [],
        'price' => [],
    ];

    public $link;
    public function mount($category)
    {
        $this->link = ModelsCategory::where('link',$category)->first();
    }
    public function add_wishlist($id)
    {
        if(auth()->user()){
        $favorite = favorite::query()->create([
            'product_id'=>$id,
            'user_id'=>auth()->user()->id
        ]);
        $this->emit('toast', 'success', 'این محصول با موفقیت به لیست علاقه مندی ها اضافه شد');

        }else{
            return redirect()->route('login');
        }
    }
    public function remove_wishlist($id)
    {
       $favorite = favorite::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
       $favorite->delete();
       $this->emit('toast', 'success', 'این محصول با موفقیت از لیست علاقه مندی ها حذف شد');
    }

    public function removeCart($id)
    {
        $sessionCart = Session::get('cart',[]);
        if (isset($sessionCart[$id])) {
            unset($sessionCart[$id]);
            Session::put('cart',$sessionCart);
        }

        $cart = cart::find($id);
        if (isset($cart)) {
            $cart = cart::find($id);
            $cart->delete();
        }
    }


    public function resets()
    {
        $this->selected['price'] = "";
        $this->selected['category'] = [];
        $this->selected['color'] = [];
        $this->selected['size'] = [];
    }

    public function orderForm()
    {
        include_once __DIR__."/../../../../Modules/OrderForm.php";
    }

    public function render()
    {
        if(! $this->link){
            abort(404);
        }else{
            if (auth()->user()) {
                $carts = cart::where('user_id', auth()->user()->id)->where('status', 0)->get();
            } else {
                $session_cart = Session::get('cart');
                if(!empty($session_cart)){
                    $carts = $session_cart;
                }else{
                    $carts = null;
                }

            }
            $category = ModelsCategory::where('id',$this->link->id)->first();
            if ($this->selected['price']) {
                $products = product::where('status', 1)->where('category_id',$this->link->id)->Where('price', '<=', $this->selected['price'])->latest()->paginate(12);
                return view('livewire.home.product.category',compact('products','carts','category'))->layout('layouts.product');
            } else {
                $products = product::where('category_id',$this->link->id)->where('status',1)->latest()->paginate(12);
            }


            if (!empty($this->selected['size'])) {
                $products = product::where('status', 1)->where('category_id',$this->link->id)
                    ->whereIn('id', function ($query) {
                        $query->select('product_id')
                            ->from('sizes')
                            ->where('name', $this->selected['size']);
                    })
                    ->latest()
                    ->paginate(12);
                    return view('livewire.home.product.category',compact('products','category','carts'))->layout('layouts.product');


            } else {
                $products = product::where('category_id',$this->link->id)->where('status',1)->latest()->paginate(12);
            }

            if (!empty($this->selected['color'])) {
                $products = product::where('status', 1)->where('category_id',$this->link->id)
                    ->whereIn('id', function ($query) {
                        $query->select('product_id')
                            ->from('colors')
                            ->where('name', $this->selected['color']);
                    })
                    ->latest()
                    ->paginate(12);
                    return view('livewire.home.product.category',compact('products','category','carts'))->layout('layouts.product');
            } else {
                $products = product::where('category_id',$this->link->id)->where('status',1)->latest()->paginate(12);
            }

            if (auth()->user()) {
                $carts = cart::where('user_id', auth()->user()->id)->where('status', 0)->get();
            } else {
                $session_cart = Session::get('cart');
                if(!empty($session_cart)){
                    $carts = $session_cart;
                }else{
                    $carts = null;
                }

            }

            $category = ModelsCategory::where('id',$this->link->id)->first();
            $products = product::where('category_id',$this->link->id)->where('status',1)->latest()->paginate(12);
        }

        SEOMeta::setTitle('محصولات '.$category->title);
        SEOMeta::setDescription($category->description);
        OpenGraph::setDescription($category->description);
        OpenGraph::setTitle('محصولات '.$category->title .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        OpenGraph::addProperty('updated_time',$category->updated_at->toW3CString());

        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('محصولات '.$category->title .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription($category->description);
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img);

        JsonLd::setType('website');
        JsonLd::setTitle('محصولات '.$category->title .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($category->description);
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img);

        return view('livewire.home.product.category',compact('products','category','carts'))->layout('layouts.product');
    }
}
