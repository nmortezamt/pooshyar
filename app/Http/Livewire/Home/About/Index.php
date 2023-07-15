<?php

namespace App\Http\Livewire\Home\About;

use App\Models\cart;
use App\Models\footerTitle;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{

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

        SEOMeta::setTitle('درباره ما');
        $description = footerTitle::get();
        SEOMeta::setDescription($description[5]->title);
        OpenGraph::setDescription($description[5]->title);
        OpenGraph::setTitle('پوشیار - '.'درباره ما');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

        return view('livewire.home.about.index',compact('carts'))->layout('layouts.product');
    }
}
