<?php

namespace App\Http\Livewire\Home\Article;

use App\Models\article;
use App\Models\cart;
use App\Models\categoryArticle;
use App\Models\commentArticle;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SingleArticle extends Component
{
    public commentArticle $comment;
    public $article;
    public function mount($link)
    {
        $this->article = article::where('link',$link)->first();
        $this->comment = new commentArticle();

    }
    //comment for users the not login
    protected $rules =[
        'comment.name'=>'required | max:40',
        'comment.email'=> 'required | email',
        'comment.comment'=> 'required',
    ];

    public function commentForm()
    {
        $this->validate();
        $comment = new commentArticle([
            'name'=>$this->comment->name,
            'email'=>$this->comment->email,
            'comment'=>$this->comment->comment,
        ]);
        $comment->article()->associate($this->article->id);
        $comment->save();
        $this->emit('toast', 'success', ' نظر شما با موفقیت ثبت شد');
        $this->comment->name ="";
        $this->comment->email ="";
        $this->comment->comment ="";
    }

    public function commentFormAuth()
    {
        $comment = new commentArticle([
            'user_id'=>auth()->user()->id,
            'comment'=>$this->comment->comment,
        ]);
        $comment->article()->associate($this->article->id);
        $comment->save();
        $this->emit('toast', 'success', ' نظر شما با موفقیت ثبت شد');
        $this->comment->comment ="";
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

    public function nextPost($id)
    {
        $articleCurrent = article::findOrFail($id);
        $nextArticle = article::where('id','>',$articleCurrent->id)->first();
        if(isset($nextArticle))
        return redirect()->route('article.single.index',$nextArticle->link);
        $this->emit('toast', 'warning', ' این آخرین مقاله است');


    }

    public function previousPost($id)
    {
        $articleCurrent = article::findOrFail($id);
        $previousArticle = article::where('id','<',$articleCurrent->id)->first();
        if(isset($previousArticle))
        return redirect()->route('article.single.index',$previousArticle->link);
        $this->emit('toast', 'warning', ' این اولین مقاله است');


    }

    public function render()
    {
        if(! $this->article){
            abort(404);
        }else{
            $article = article::where('id',$this->article->id)->first();
            $category = categoryArticle::where('id',$article->category_article_id)->first();
            $comments = commentArticle::where([['status',1],['article_id',$article->id]])->count();
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

        SEOMeta::setTitle($article->title);
        SEOMeta::setDescription($article->description);
        OpenGraph::setDescription($article->description);
        OpenGraph::setTitle($article->title .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        SEOMeta::addMeta('article:section', $article->category->title, 'property');
        OpenGraph::addProperty('updated_time',$article->updated_at->toW3CString());
        SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(), 'property');

        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$article->img,['height' => 300, 'width' => 300]);

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle($article->title .' - پوشیار');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setDescription($article->description);
        TwitterCard::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$article->img);

        JsonLd::setType('article');
        JsonLd::setTitle($article->title .' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($article->description);
        JsonLd::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$article->img);

        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        return view('livewire.home.article.single-article',compact('article','category','comments','carts'))->layout('layouts.article');
    }
}
