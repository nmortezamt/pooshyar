<?php

namespace App\Http\Livewire\Home\Article;

use App\Models\article;
use App\Models\cart;
use App\Models\subcategoryArticle;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Subcategory extends Component
{
    public $subcategory;
    public function mount($link)
    {
        $this->subcategory = subcategoryArticle::where('link',$link)->first();
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
        if(! $this->subcategory){
            abort(404);
        }else{
        $articles = article::where('subcategory_article_id',$this->subcategory->id)->latest()->paginate(10);
        $subcategory = $this->subcategory;
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

        SEOMeta::setTitle('مقالات '.$subcategory->title);
        SEOMeta::setDescription($subcategory->description);
        OpenGraph::setDescription($subcategory->description);
        OpenGraph::setTitle('مقالات '.$subcategory->title .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        OpenGraph::addProperty('updated_time',$subcategory->updated_at->toW3CString());

        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img,['height' => 300, 'width' => 300]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');
        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('مقالات '.$subcategory->title .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription($subcategory->description);
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img);

        JsonLd::setType('website');
        JsonLd::setTitle('مقالات '.$subcategory->title .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($subcategory->description);
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$subcategory->img);
        return view('livewire.home.article.subcategory',compact('articles','subcategory','carts'))->layout('layouts.article');
    }
}
