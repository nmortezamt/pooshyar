<?php

namespace App\Http\Livewire\Home\Article;

use App\Models\article;
use App\Models\cart;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AllArticle extends Component
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

        $articles = article::where('status',1)->latest()->paginate(10);


        SEOMeta::setTitle('مقالات');
        SEOMeta::setDescription('تولید و پخش پوشیار | مقالات');
        OpenGraph::setDescription('تولید و پخش پوشیار | مقالات');
        OpenGraph::setTitle('مقالات'.' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::addProperty('locale:alternate', ['fa_IR']);
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');

        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img,['height' => 300, 'width' => 300]);

        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('مقالات'.' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription('تولید و پخش پوشیار | مقالات');
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);

        JsonLd::setType('website');
        JsonLd::setTitle('مقالات'.' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription('تولید و پخش پوشیار | مقالات');
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);

        return view('livewire.home.article.all-article',compact('articles','carts'))->layout('layouts.article');
    }
}
