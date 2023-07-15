<?php

namespace App\Http\Livewire\Home\Product;

use App\Models\cart;
use App\Models\color;
use App\Models\favorite;
use App\Models\logoSite;
use App\Models\order;
use App\Models\product;
use App\Models\productColorOrder;
use App\Models\productSizeOrder;
use App\Models\size;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AllProduct extends Component
{
    public $selected = [
        'category' => [],
        'size' => [],
        'color' => [],
        'price' => [],
    ];
    public $sort_product;


    public function add_wishlist($id)
    {
        if (auth()->user()) {
            $favorite = favorite::query()->create([
                'product_id' => $id,
                'user_id' => auth()->user()->id
            ]);
            $this->emit('toast', 'success', 'این محصول با موفقیت به لیست علاقه مندی ها اضافه شد');
        } else {
            return redirect()->route('login');
        }
    }
    public function remove_wishlist($id)
    {
        $favorite = favorite::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
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


        if ($this->selected['price']) {

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

            $products = product::where('status', 1)->Where('price', '<=', $this->selected['price'])->latest()->paginate(12);
            return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
        } else {
            $products = product::where('status', 1)->latest()->paginate(12);

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
        }

        if ($this->selected['category']) {
            foreach ($this->selected['category'] as $key => $value) {
                $products = product::where('status', 1)->where('category_id', $value)->latest()->paginate(12);
            }

            return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
        }

        if (!empty($this->selected['size'])) {

            $products = product::where('status', 1)
                ->whereIn('id', function ($query) {
                    $query->select('product_id')
                        ->from('sizes')
                        ->where('name', $this->selected['size']);
                })
                ->latest()
                ->paginate(12);
            return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
        } else {
            $products = product::where('status', 1)->latest()->paginate(12);
        }

        if (!empty($this->selected['color'])) {
            $products = product::where('status', 1)
                ->whereIn('id', function ($query) {
                    $query->select('product_id')
                        ->from('colors')
                        ->where('name', $this->selected['color']);
                })
                ->latest()
                ->paginate(12);
            return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
        } else {
            $products = product::where('status', 1)->latest()->paginate(12);
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

        $products = product::where('status', 1)->latest()->paginate(12);

        SEOMeta::setTitle('محصولات');
        SEOMeta::setDescription('تولید و پخش پوشیار | عمده فروشی تونیک زنانه | فروش عمده تونیک زنانه | تولیدی لباس زنانه');
        OpenGraph::setDescription('تولید و پخش پوشیار | عمده فروشی تونیک زنانه | فروش عمده تونیک زنانه | تولیدی لباس زنانه');
        OpenGraph::setTitle('محصولات' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');

        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('محصولات' .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription('تولید و پخش پوشیار | عمده فروشی تونیک زنانه | فروش عمده تونیک زنانه | تولیدی لباس زنانه');
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);

        JsonLd::setType('website');
        JsonLd::setTitle('محصولات' .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription('تولید و پخش پوشیار | عمده فروشی تونیک زنانه | فروش عمده تونیک زنانه | تولیدی لباس زنانه');
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);
        return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
    }
}
//sort
// if ($this->sort_product) {
//     if($this->sort_product == 'price-desc'){
//         $products = product::where('status', 1)->orderBy('price', 'DESC')->latest()->paginate(12);
//         return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
//     }
//     if($this->sort_product == 'price_asc'){
//         $products = product::where('status', 1)->orderBy('price', 'ASC')->latest()->paginate(12);
//         return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
//     }
//     if($this->sort_product == 'date'){
//         $products = product::where('status', 1)->orderBy('created_at', 'DESC')->latest()->paginate(12);
//         return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
//     }
//     if($this->sort_product == 'popularity'){
//         $products = product::where('status', 1)->orderBy('view', 'DESC')->latest()->paginate(12);
//         return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
//     }
//     if($this->sort_product == 'order'){
//         $products = product::where('status', 1)->orderBy('id', 'DESC')->latest()->paginate(12);
//         return view('livewire.home.product.all-product', compact('products', 'carts'))->layout('layouts.product');
//     }

// }
