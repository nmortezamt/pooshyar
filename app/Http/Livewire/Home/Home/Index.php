<?php

namespace App\Http\Livewire\Home\Home;

use App\Models\cart;
use App\Models\favorite;
use App\Models\footerTitle;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{

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


    public function orderForm()
    {
        include_once __DIR__."/../../../../Modules/OrderForm.php";
    }

    public function render()
    {
         auth()->loginUsingId(1);
        if(auth()->user()){
            $carts = cart::where('user_id',auth()->user()->id)->where('status',0)->get();
        }else {
            $session_cart = Session::get('cart');
            if(!empty($session_cart)){
                $carts = $session_cart;
            }else{
                $carts = null;
            }

        }
        $description = footerTitle::get();
        if(count($description)) {
            SEOMeta::setTitle('تولید و پخش تونیک زنانه ');
//        SEOMeta::setDescription($description[5]->title);
//        OpenGraph::setDescription($description[5]->title);
            OpenGraph::setTitle('تولید و پخش تونیک زنانه - پوشیار');
            OpenGraph::setUrl('https://' . $_SERVER['HTTP_HOST']);
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', 'fa_IR');
            OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
            $logo = logoSite::first();
            OpenGraph::addImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $logo->img, ['height' => 300, 'width' => 300]);
            SEOMeta::setCanonical('https://' . $_SERVER['HTTP_HOST']);
            SEOMeta::setRobots('index,follow');
            TwitterCard::setType('summary_large_image');
            TwitterCard::setTitle('تولید و پخش تونیک زنانه - پوشیار');
            TwitterCard::setSite('@pooshyar');
//        TwitterCard::setDescription($description[5]->title);
            TwitterCard::setUrl('https://' . $_SERVER['HTTP_HOST']);
            TwitterCard::setImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $logo->img);

            JsonLd::setType('website');
            JsonLd::setTitle('تولید و پخش تونیک زنانه - پوشیار');
            JsonLd::setSite('pooshyar');
//        JsonLd::setDescription($description[5]->title);
            JsonLd::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);
        }
        return view('livewire.home.home.index',compact('carts'))->layout('layouts.home');
    }
}
