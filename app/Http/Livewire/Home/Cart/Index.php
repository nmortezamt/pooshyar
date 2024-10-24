<?php

namespace App\Http\Livewire\Home\Cart;

use App\Models\cart;
use App\Models\footerTitle;
use App\Models\logoSite;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\Product\Color\Models\color;
use Modules\Product\Product\Models\product;
use Modules\Product\Size\Models\size;

class Index extends Component
{

    public function addToCount($id)
    {
        // increment  for carts session
        $sessionCart = Session::get('cart', []);
        if (isset($sessionCart[$id])) {
            $product = product::findOrFail($sessionCart[$id]['product_id']);
            if ($sessionCart[$id]['type'] == 'single') {
                $qty_color = color::where('product_id', $product->id)->count();
                $qty_size = size::where('product_id', $product->id)->count();
                $result = $qty_color * $qty_size - 1;
                if ($product->number > $sessionCart[$id]['count'] && $product->order_count > $sessionCart[$id]['count'] && $sessionCart[$id]['count'] < $result) {

                    $sessionCart[$id]['count'] += 1;
                    $sessionCart[$id]['total_price'] = $sessionCart[$id]['product_price_discount'] ? $sessionCart[$id]['count'] * $sessionCart[$id]['product_price_discount'] : $sessionCart[$id]['count'] * $sessionCart[$id]['product_price'];
                    $this->emit('toast', 'success', 'محصول آپدیت شد');
                    Session::put('cart', $sessionCart);
                } else {
                    $this->emit('toast', 'warning', 'حداکثر سفارش!');
                }
            } elseif ($sessionCart[$id]['type'] == 'major') {
                $qty_color = color::where('product_id', $product->id)->count();
                $qty_size = size::where('product_id', $product->id)->count();
                if ($product->number > $sessionCart[$id]['count'] && $product->order_count > $sessionCart[$id]['count']) {
                    $sessionCart[$id]['count'] += $qty_color * $qty_size;

                    $sessionCart[$id]['total_price'] = $sessionCart[$id]['product_price_discount'] ? $sessionCart[$id]['count'] * $sessionCart[$id]['product_price_discount'] : $sessionCart[$id]['count'] * $sessionCart[$id]['product_price'];
                    Session::put('cart', $sessionCart);

                    $this->emit('toast', 'success', 'محصول آپدیت شد');
                } else {
                    $this->emit('toast', 'warning', 'حداکثر سفارش!');
                }
            }
        }

        // increment  for carts user login
        $cart = cart::findOrFail($id);
        $product = product::findOrFail($cart->product_id);
        if ($cart->type == 'single') {
            $qty_color = color::where('product_id', $product->id)->count();
            $qty_size = size::where('product_id', $product->id)->count();
            $result = $qty_color * $qty_size - 1;
            if ($product->number > $cart->count && $product->order_count > $cart->count && $cart->count < $result) {

                $cart->update([
                    'count' => $cart->count += 1
                ]);
                $cart->update([
                    'total_price' => $cart->product_price_discount ? $cart->count * $cart->product_price_discount : $cart->count * $cart->product_price
                ]);

                $this->emit('toast', 'success', 'محصول آپدیت شد');
            } else {
                $this->emit('toast', 'warning', 'حداکثر سفارش!');
            }
        } elseif ($cart->type == 'major') {
            $qty_color = color::where('product_id', $product->id)->count();
            $qty_size = size::where('product_id', $product->id)->count();
            if ($product->number > $cart->count && $product->order_count > $cart->count) {

                $cart->update([
                    'count' => $cart->count += $qty_color * $qty_size
                ]);
                $cart->update([
                    'total_price' => $cart->product_price_discount ? $cart->count * $cart->product_price_discount : $cart->count * $cart->product_price
                ]);

                $this->emit('toast', 'success', 'محصول آپدیت شد');
            } else {
                $this->emit('toast', 'warning', 'حداکثر سفارش!');
            }
        }
    }

    public function removeToCount($id)
    {
        //decrement for carts session

        $sessionCart = Session::get('cart', []);
        if (isset($sessionCart[$id])) {
            $product = product::findOrFail($sessionCart[$id]['product_id']);
            if ($sessionCart[$id]['type'] == 'single') {
                if ($sessionCart[$id]['count'] > 1) {
                    $sessionCart[$id]['count'] -= 1;
                    $sessionCart[$id]['total_price'] = $sessionCart[$id]['product_price_discount'] ? $sessionCart[$id]['count'] * $sessionCart[$id]['product_price_discount'] : $sessionCart[$id]['count'] * $sessionCart[$id]['product_price'];
                    Session::put('cart', $sessionCart);

                    $this->emit('toast', 'success', 'محصول آپدیت شد');
                }
            } elseif ($sessionCart[$id]['type'] == 'major') {
                $qty_color = color::where('product_id', $product->id)->count();
                $qty_size = size::where('product_id', $product->id)->count();
                $result = $qty_color * $qty_size;
                if ($sessionCart[$id]['count'] > $result) {
                    $sessionCart[$id]['count'] -= $result;
                    $sessionCart[$id]['total_price'] = $sessionCart[$id]['product_price_discount'] ? $sessionCart[$id]['count'] * $sessionCart[$id]['product_price_discount'] : $sessionCart[$id]['count'] * $sessionCart[$id]['product_price'];
                    Session::put('cart', $sessionCart);

                    $this->emit('toast', 'success', 'محصول آپدیت شد');
                }
            }
        }

        // decrement for carts user login

        $cart = cart::findOrFail($id);
        $product = product::findOrFail($cart->product_id);
        if ($cart->type == 'single') {
            if ($cart->count > 1) {

                $cart->update([
                    'count' => $cart->count -= 1
                ]);
                $cart->update([
                    'total_price' => $cart->product_price_discount ? $cart->count * $cart->product_price_discount : $cart->count * $cart->product_price
                ]);

                $this->emit('toast', 'success', 'محصول آپدیت شد');
            }
        } elseif ($cart->type == 'major') {
            $qty_color = color::where('product_id', $product->id)->count();
            $qty_size = size::where('product_id', $product->id)->count();
            $result = $qty_color * $qty_size;
            if ($cart->count > $result) {
                $cart->update([
                    'count' => $cart->count -= $result
                ]);
                $cart->update([
                    'total_price' => $cart->product_price_discount ? $cart->count * $cart->product_price_discount : $cart->count * $cart->product_price
                ]);

                $this->emit('toast', 'success', 'محصول آپدیت شد');
            }
        }
    }

    public function removeCart($id)
    {
        //remove for cart session
        $sessionCart = Session::get('cart', []);
        if (isset($sessionCart[$id])) {
            unset($sessionCart[$id]);
            Session::put('cart', $sessionCart);
        }
        // remove for cart user login
        $cart = cart::find($id);
        if (isset($cart)) {
            $cart = cart::find($id);
            $cart->delete();
            $this->emit('toast', 'success', 'محصول از سبد خرید حذف شد');
        }
    }


    public function orderForm()
    {
        include_once __DIR__ . "/../../../../Modules/OrderForm.php";
    }

    public function render()
    {

        $product_number_nulls = product::where('number', 0)->get();
        if ($product_number_nulls) {
            foreach ($product_number_nulls as $product_number) {
                $cart_delete = cart::where('product_id', $product_number->id)->delete();
            }
        }

        if (auth()->user()) {
            $carts = cart::where('user_id', auth()->user()->id)->where('status', 0)->latest()->get();
        } else {
            $session_cart = Session::get('cart');
            if (!empty($session_cart)) {
                $carts = $session_cart;
            } else {
                $carts = null;
            }
        }
        if(false) {
            SEOMeta::setTitle('سبد خرید');
            $description = footerTitle::get();
//        SEOMeta::setDescription($description[5]->title);
//        OpenGraph::setDescription($description[5]->title);
            OpenGraph::setTitle('سبد خرید' . ' - پوشیار');
            OpenGraph::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', 'fa_IR');
            OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
            $logo = logoSite::first();
            OpenGraph::addImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $logo->img, ['height' => 300, 'width' => 300]);
            SEOMeta::setCanonical('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            SEOMeta::setRobots('index,follow');

            TwitterCard::setType('summary_large_image');
            TwitterCard::setTitle('سبد خرید' . ' - پوشیار');
            TwitterCard::setSite('@pooshyar');
            TwitterCard::setDescription($description[5]->title);
            TwitterCard::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            TwitterCard::setImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $logo->img);

            JsonLd::setType('website');
            JsonLd::setTitle('سبد خرید' . ' - پوشیار');
            JsonLd::setSite('pooshyar');
            JsonLd::setDescription($description[5]->title);
            JsonLd::setUrl('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            JsonLd::setImage('https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $logo->img);
        }
        return view('livewire.home.cart.index', compact('carts'))->layout('layouts.product');
    }
}
