<?php

namespace App\Http\Livewire\Home\Product;

use App\Models\answerCommentProduct;
use App\Models\cart;
use App\Models\commentProduct;
use App\Models\favorite;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\Category\Models\category;
use Modules\Product\Color\Models\color;
use Modules\Product\Gallery\Models\gallery;
use Modules\Product\Product\Models\product;
use Modules\Product\Size\Models\size;
use Stevebauman\Location\Facades\Location;

class Index extends Component
{
    public product $product;
    public $rate;
    public $color;
    public $size;
    public $buyType = 'single';
    public $countSingle = 1;
    public $countMajor;

    public commentProduct $comment;

    public function mount(product $id)
    {
        $this->product = $id;
        $this->comment = new commentProduct();
        $qty_color = color::where('product_id', $this->product->id)->count();
        $qty_size = size::where('product_id', $this->product->id)->count();
        $this->countMajor = $qty_color * $qty_size;
        $this->product->update([
            'view' => $this->product->view +=1
        ]);
    }


    protected $rules = [
        'comment.comment' => 'required',
    ];

    public function rate($id)
    {
        $this->rate = $id;
    }

    public function add_favorite($id)
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

    public function add_wishlist_releted($id)
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

    public function remove_wishlist_releted($id)
    {
        $favorite = favorite::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
        $favorite->delete();
        $this->emit('toast', 'success', 'این محصول با موفقیت از لیست علاقه مندی ها حذف شد');
    }

    public function commentForm()
    {
        if (auth()->user()) {
            $comment = new commentProduct([
                'user_id' => auth()->user()->id,
                'comment' => $this->comment->comment,
                'rate' => $this->rate
            ]);
            if ($comment->rate == null) {
                $this->emit('toast', 'warning', 'امتیاز داده نشده');
            } else {
                $comment->product()->associate($this->product->id);
                $comment->save();
                $this->emit('toast', 'success', ' نظر شما با موفقیت ثبت شد');
                $this->comment->comment = "";
                $this->rate = null;
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function addToCount()
    {
        if ($this->buyType == 'single') {
            $qty_color = color::where('product_id', $this->product->id)->count();
            $qty_size = size::where('product_id', $this->product->id)->count();
            $result = $qty_color * $qty_size - 1;
            if ($this->product->number > $this->countSingle && $this->countSingle < $result && $this->product->order_count > $this->countSingle) {
                $this->countSingle += 1;
            } else {
                $this->emit('toast', 'warning', 'حداکثر سفارش!');
            }
        } elseif ($this->buyType == 'major') {
            if ($this->product->number > $this->countMajor && $this->product->order_count > $this->countMajor) {
                $qty_color = color::where('product_id', $this->product->id)->count();
                $qty_size = size::where('product_id', $this->product->id)->count();

                $this->countMajor += $qty_color * $qty_size;
            } else {
                $this->emit('toast', 'warning', 'حداکثر سفارش!');
            }
        }
    }
    public function removeOfCount()
    {
        if ($this->buyType == 'single') {
            if ($this->countSingle > 1) {
                $this->countSingle -= 1;
            }
        } elseif ($this->buyType == 'major') {
            $qty_color = color::where('product_id', $this->product->id)->count();
            $qty_size = size::where('product_id', $this->product->id)->count();
            if ($this->countMajor > $qty_color * $qty_size) {
                $this->countMajor -= $qty_color * $qty_size;
            }
        }
    }

    public function color($id)
    {
        $this->color = color::where('id', $id)->pluck('id', 'name')->toArray();
    }
    public function size($id)
    {
        $this->size = size::where('id', $id)->pluck('id', 'name')->toArray();
    }

    public function addToCart($id)
    {
        $product = product::findOrFail($id);

        if ($this->buyType == 'single') {
            if (auth()->user()) {
                $check_cart = cart::where('user_id', auth()->user()->id)
                    ->where('product_id', $product->id)
                    ->where('type', 'single')
                    ->where('status', 0)
                    ->where('color_id', json_encode($this->color))
                    ->where('size_id', json_encode($this->size))
                    ->first();
            }else{
                $session_cart = Session::get('cart');
                if(!empty($session_cart)){
                    foreach ($session_cart as $item) {
                        $check_cart = cart::where('product_id', $item['product_id'])
                        ->where('id', $item['id'])
                        ->where('type', 'single')
                        ->where('status', 0)
                        ->where('color_id', json_encode($this->color))
                        ->where('size_id', json_encode($this->size))
                        ->first();
                    }
                }else{
                    $check_cart = null;
                }
            }
            if (isset($check_cart)) {
                $this->emit('toast', 'warning', 'قبلا این محصول را با این مشخصات در سبد خرید اضافه کرده اید!');
            } else {

                if ($this->color != null) {
                    if ($this->size != null) {
                        $local = Request::ip();
                        if ($local == '127.0.0.1') {

                            if (auth()->user()) {
                                $cart = cart::query()->create([
                                    'product_id' => $product->id,
                                    'user_id' => auth()->user()->id,
                                    'ip' => $local,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ? $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ]);
                                $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                            } else {
                                $cart = cart::query()->create([
                                    'product_id' => $product->id,
                                    'ip' => $local,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ?    $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ]);
                                $session_cart[$cart->id] = [
                                    'id'=> $cart->id,
                                    'product_id' => $product->id,
                                    'ip' => $local,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ?    $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ];
                                Session::put('cart',$session_cart);

                                $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                            }
                        } else {
                            $userIp = Request::ip();
                            $location = Location::get($userIp);
                            if (auth()->user()) {
                                $cart = cart::query()->create([
                                    'product_id' => $product->id,
                                    'user_id' => auth()->user()->id,
                                    'ip' => $userIp,
                                    'countryName' => $location->countryName,
                                    'countryCode' => $location->countryCode,
                                    'regionCode' => $location->regionCode,
                                    'regionName' => $location->regionName,
                                    'cityName' => $location->cityName,
                                    'zipCode' => $location->zipCode,
                                    'isoCode' => $location->isoCode,
                                    'postalCode' => $location->postalCode,
                                    'latitude' => $location->latitude,
                                    'longitude' => $location->longitude,
                                    'metroCode' => $location->metroCode,
                                    'areaCode' => $location->areaCode,
                                    'timezone' => $location->timezone,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ?    $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ]);
                                $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                            } else {
                                $cart = cart::query()->create([
                                    'product_id' => $product->id,
                                    'ip' => $userIp,
                                    'countryName' => $location->countryName,
                                    'countryCode' => $location->countryCode,
                                    'regionCode' => $location->regionCode,
                                    'regionName' => $location->regionName,
                                    'cityName' => $location->cityName,
                                    'zipCode' => $location->zipCode,
                                    'isoCode' => $location->isoCode,
                                    'postalCode' => $location->postalCode,
                                    'latitude' => $location->latitude,
                                    'longitude' => $location->longitude,
                                    'metroCode' => $location->metroCode,
                                    'areaCode' => $location->areaCode,
                                    'timezone' => $location->timezone,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ? $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ]);

                                $session_cart[$cart->id] = [
                                    'id'=> $cart->id,
                                    'product_id' => $product->id,
                                    'ip' => $userIp,
                                    'color_id' => json_encode($this->color),
                                    'size_id' => json_encode($this->size),
                                    'product_price' => $product->price,
                                    'product_price_discount' => $product->discount_price ?    $product->price / 100 * (100 - $product->discount_price) : null,
                                    'total_price' => $product->discount_price ? $this->countSingle * $product->price / 100 * (100 - $product->discount_price) : $this->countSingle * $product->price,
                                    'count' => $this->countSingle,
                                    'type' => $this->buyType,
                                ];
                                Session::put('cart',$session_cart);

                                $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');

                            }
                        }
                    } else {
                        $this->emit('toast', 'warning', 'سایز محصول را انتخاب نکرده اید!');
                    }
                } else {
                    $this->emit('toast', 'warning', 'رنگ محصول را انتخاب نکرده اید!');
                }
            }
        } elseif ($this->buyType == 'major') {
            $colors = color::where('product_id', $product->id)->pluck('id', 'name')->toArray();
            $sizes = size::where('product_id', $product->id)->pluck('id', 'name')->toArray();
            if(auth()->user()){
                $caart = cart::where('user_id',auth()->user()->id)->where('product_id', $product->id)->where('status', 0)->where('type', 'major')->first();
                }else{
                    $session_cart = Session::get('cart');
                    if(!empty($session_cart)){
                        foreach ($session_cart as $item) {
                            if($item['product_id'] == $product->id && $item['type'] == 'major'){
                                $caart = cart::where('id', $item['id'])
                                ->first();
                                }else{
                                    $caart = null;
                                }
                        }
                    }else{
                        $caart = null;
                    }
            }
            if (isset($caart)) {
                $this->emit('toast', 'warning', 'قبلا این محصول در سبد خرید اضافه کرده اید!');
            } else {
                $local = Request::ip();
                if ($local == '127.0.0.1') {
                    if (auth()->user()) {
                        $cart = cart::query()->create([
                            'product_id' => $product->id,
                            'user_id' => auth()->user()->id,
                            'ip' => $local,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ? $product->price_major / 100 * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major / 100 * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,
                        ]);

                        $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                    } else {
                        $cart = cart::query()->create([
                            'product_id' => $product->id,
                            'ip' => $local,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ?    $product->price_major / 100 * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major / 100 * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,
                        ]);

                            $session_cart[$cart->id] = [
                            'id'=> $cart->id,
                            'product_id' => $product->id,
                            'ip' => $local,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ?    $product->price_major / 100 * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major / 100 * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,
                        ];

                        Session::put('cart',$session_cart);
                        $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                    }
                } else {
                    $userIp = Request::ip();
                    $location = Location::get($userIp);
                    if (auth()->user()) {
                        $cart = cart::query()->create([
                            'product_id' => $product->id,
                            'user_id' => auth()->user()->id,
                            'ip' => $userIp,
                            'countryName' => $location->countryName,
                            'countryCode' => $location->countryCode,
                            'regionCode' => $location->regionCode,
                            'regionName' => $location->regionName,
                            'cityName' => $location->cityName,
                            'zipCode' => $location->zipCode,
                            'isoCode' => $location->isoCode,
                            'postalCode' => $location->postalCode,
                            'latitude' => $location->latitude,
                            'longitude' => $location->longitude,
                            'metroCode' => $location->metroCode,
                            'areaCode' => $location->areaCode,
                            'timezone' => $location->timezone,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ?    $product->price_major / 100 * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major / 100 * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,
                        ]);
                        $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                    } else {
                        $cart = cart::query()->create([
                            'product_id' => $product->id,
                            'ip' => $userIp,
                            'countryName' => $location->countryName,
                            'countryCode' => $location->countryCode,
                            'regionCode' => $location->regionCode,
                            'regionName' => $location->regionName,
                            'cityName' => $location->cityName,
                            'zipCode' => $location->zipCode,
                            'isoCode' => $location->isoCode,
                            'postalCode' => $location->postalCode,
                            'latitude' => $location->latitude,
                            'longitude' => $location->longitude,
                            'metroCode' => $location->metroCode,
                            'areaCode' => $location->areaCode,
                            'timezone' => $location->timezone,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ? $product->price_major * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,

                        ]);

                        $session_cart[$cart->id] = [
                            'id'=> $cart->id,
                            'product_id' => $product->id,
                            'ip' => $userIp,
                            'color_id' => json_encode($colors),
                            'size_id' => json_encode($sizes),
                            'product_price' => $product->price_major,
                            'product_price_discount' => $product->discount_price ?    $product->price_major / 100 * (100 - $product->discount_price) : null,
                            'total_price' => $product->discount_price ? $this->countMajor * $product->price_major / 100 * (100 - $product->discount_price) : $this->countMajor * $product->price_major,
                            'count' => $this->countMajor,
                            'type' => $this->buyType,
                        ];

                        Session::put('cart',$session_cart);
                        $this->emit('toast', 'success', ' محصول با موفقیت به سبد خرید شما اضافه شد');
                    }
                }
            }
        }
    }

    public function removeOfCart($id)
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
            $this->emit('toast', 'success', 'محصول از سبد خرید حذف شد');
        }
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
        include_once __DIR__ . "/../../../../Modules/OrderForm.php";
    }

    public function render()
    {
        $product = $this->product;
        $galleries = gallery::where('product_id', $this->product->id)->orderBy('position')->get();
        $category = category::where('id', $product->category_id)->first();
        $comments = commentProduct::where('product_id', $product->id)->where('status', 1)->latest()->get();
        $countComment = commentProduct::where('product_id', $product->id)->where('status', 1)->count();
        $countCommentAnswer = answerCommentProduct::where('product_id', $product->id)->count();
        $sum = commentProduct::where('product_id', $product->id)->where('status', 1)->sum('rate');
        if ($countComment != null) {
            $rating = $sum / $countComment;
        } else {
            $rating = 0;
        }


        if(auth()->user()){
            if ($this->buyType == 'single') {
                $caart = cart::where('user_id', auth()->user()->id)
                ->where('product_id', $this->product->id)
                ->where('type', 'single')
                ->where('status', 0)
                ->where('color_id', json_encode($this->color))
                ->where('size_id', json_encode($this->size))
                ->first();
            } elseif ($this->buyType == 'major') {
                $caart = cart::where('user_id',auth()->user()->id)->where('product_id', $product->id)->where('status', 0)->where('type', 'major')->first();
            }
        }else{
            if ($this->buyType == 'single') {
                $session_cart = Session::get('cart');
                if(!empty($session_cart)){
                foreach ($session_cart as $item) {
                    $caart = cart::where('product_id', $item['product_id'])
                    ->where('id', $item['id'])
                    ->where('type', 'single')
                    ->where('status', 0)
                    ->where('color_id', json_encode($this->color))
                    ->where('size_id', json_encode($this->size))
                    ->first();
                }
            }else{
                $caart = null;
            }

            } elseif ($this->buyType == 'major') {
                $session_cart = Session::get('cart');
                if(!empty($session_cart)){
                    foreach ($session_cart as $item) {
                        if($item['product_id'] == $product->id && $item['type'] == 'major'){
                        $caart = cart::where('id', $item['id'])
                        ->first();
                        }else{
                            $caart = null;
                        }
                    }
                }else{
                    $caart = null;
                }
            }
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

        SEOMeta::setTitle($product->title);
        SEOMeta::setDescription($product->description_seo);
        OpenGraph::setDescription($product->description_seo);
        OpenGraph::setTitle($product->title . ' - پوشیار');
        OpenGraph::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'product');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        SEOMeta::addMeta('product:section', $product->category->title, 'property');
        OpenGraph::addProperty('updated_time', $product->updated_at->toW3CString());
        SEOMeta::addMeta('product:release_date', $product->created_at->toW3CString(), 'property');

        OpenGraph::addImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $product->img, ['height' => 300, 'width' => 300]);

        SEOMeta::setCanonical('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        TwitterCard::setType('summary_large_image');
        TwitterCard::setSite('@pooshyar');
        TwitterCard::setTitle($product->title . ' - پوشیار');
        TwitterCard::setDescription($product->description_seo);
        TwitterCard::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        TwitterCard::setImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $product->img);

        JsonLd::setType('product');
        JsonLd::setTitle($product->title . ' - پوشیار');
        JsonLd::setSite('pooshyar');
        JsonLd::setDescription($product->description_seo);
        JsonLd::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        JsonLd::setImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $product->img);
        return view('livewire.home.product.index', compact('product', 'galleries', 'category', 'comments', 'countComment', 'countCommentAnswer', 'rating', 'caart', 'carts'))->layout('layouts.product');
    }
}
