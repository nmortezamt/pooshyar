<?php

namespace App\Http\Livewire\Home\Article;

use App\Models\article;
use App\Models\cart;
use App\Models\categoryArticle;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Category extends Component
{
    public $category;
    public function mount($link)
    {
        $this->category = categoryArticle::where('link',$link)->first();
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
        if(! $this->category){
            abort(404);
        }else{
        $articles = article::where('category_article_id',$this->category->id)->latest()->paginate(10);
        $category = $this->category;

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

        SEOMeta::setTitle('مقالات '.$category->title);
        SEOMeta::setDescription($category->description);
        OpenGraph::setDescription($category->description);
        OpenGraph::setTitle('مقالات '.$category->title .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        OpenGraph::addProperty('updated_time',$category->updated_at->toW3CString());

        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img,['height' => 300, 'width' => 300]);

        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('مقالات '.$category->title .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription($category->description);
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img);

        JsonLd::setType('website');
        JsonLd::setTitle('مقالات '.$category->title .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($category->description);
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$category->img);

        return view('livewire.home.article.category',compact('articles','category','carts'))->layout('layouts.article');
    }
}
