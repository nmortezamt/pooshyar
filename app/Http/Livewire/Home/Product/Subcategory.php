<?php

namespace App\Http\Livewire\Home\Product;

use App\Models\cart;
use App\Models\color;
use App\Models\favorite;
use App\Models\order;
use App\Models\product;
use App\Models\productColorOrder;
use App\Models\productSizeOrder;
use App\Models\size;
use App\Models\subcategory as ModelsSubcategory;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Subcategory extends Component
{
    public $selected = [
        'category' => [],
        'size' => [],
        'color' => [],
        'price' => [],
    ];
    public $sort_product;
    public $slink;

    public function mount($subcategory)
    {
        $this->slink = ModelsSubcategory::where('link', $subcategory)->first();
    }
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
        if (!$this->slink) {
            abort(404);
        } else {
            $subcategory = ModelsSubcategory::where('id', $this->slink->id)->first();
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
                $products = product::where('status', 1)->where('subcategory_id', $subcategory->id)->Where('price', '<=', $this->selected['price'])->latest()->paginate(12);
                return view('livewire.home.product.subcategory', compact('products', 'subcategory', 'carts'))->layout('layouts.product');
            } else {
                $products = product::where('subcategory_id', $subcategory->id)->where('status', 1)->latest()->paginate(12);
            }

            if (!empty($this->selected['size'])) {
                $products = product::where('status', 1)->where('subcategory_id', $subcategory->id)
                    ->whereIn('id', function ($query) {
                        $query->select('product_id')
                            ->from('sizes')
                            ->where('name', $this->selected['size']);
                    })
                    ->latest()
                    ->paginate(12);
                return view('livewire.home.product.subcategory', compact('products', 'subcategory', 'carts'))->layout('layouts.product');
            } else {
                $products = product::where('subcategory_id', $subcategory->id)->where('status', 1)->latest()->paginate(12);
            }

            if (!empty($this->selected['color'])) {
                $products = product::where('status', 1)->where('subcategory_id', $subcategory->id)
                    ->whereIn('id', function ($query) {
                        $query->select('product_id')
                            ->from('colors')
                            ->where('name', $this->selected['color']);
                    })
                    ->latest()
                    ->paginate(12);
                return view('livewire.home.product.subcategory', compact('products', 'subcategory', 'carts'))->layout('layouts.product');
            } else {
                $products = product::where('subcategory_id', $subcategory->id)->where('status', 1)->latest()->paginate(12);
            }

            $subcategory = ModelsSubcategory::where('id', $this->slink->id)->first();
            $products = product::where('subcategory_id', $subcategory->id)->latest()->paginate(12);

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

        SEOMeta::setTitle('محصولات '.$subcategory->title);
        SEOMeta::setDescription($subcategory->description);
        OpenGraph::setDescription($subcategory->description);
        OpenGraph::setTitle('محصولات '.$subcategory->title .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        OpenGraph::addProperty('updated_time',$subcategory->updated_at->toW3CString());

        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('محصولات '.$subcategory->title .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription($subcategory->description);
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img);

        JsonLd::setType('website');
        JsonLd::setTitle('محصولات '.$subcategory->title .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($subcategory->description);
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img);

        return view('livewire.home.product.subcategory', compact('products', 'subcategory', 'carts'))->layout('layouts.product');
    }
}
