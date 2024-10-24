<?php

namespace App\Http\Livewire\Home\Order;

use App\Models\bankPayment;
use App\Models\cart;
use App\Models\discountCode;
use App\Models\footerTitle;
use App\Models\logoSite;
use App\Models\order;
use App\Models\payment;
use App\Models\productColorOrder;
use App\Models\productSizeOrder;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\User\Models\User;

class Index extends Component
{
    public $code;
    public $discount_price;
    public $discount_percent;
    public $sum_price_order;
    public $discount_code;
    public $order;
    public $account;
    public $password2;
    public $passwordLogin;
    public $emailLogin;
    public payment $payment;


    public function mount($order)
    {
        $this->sum_price_order = order::where('order_count', $order)->sum('price');
        $this->order = $order;
        $this->payment = new payment();
    }
    protected $rules = [
        'payment.name' => 'required | alpha_spaces | max:20',
        'payment.lname' => 'required | alpha_spaces | max:25',
        'payment.state' => 'required | alpha_spaces | max:20',
        'payment.city' => 'required | alpha_spaces | max:25',
        'payment.address' => 'required | alpha_spaces | max:130',
        'payment.address2' => 'nullable | alpha_spaces |max:50',
        'payment.postal_code' => 'required | alpha_num | max:10 | min:10',
        'payment.email' => 'required | email',
        'payment.phone' => 'required | regex:/^09\d{9}$/',
        'payment.info' => 'nullable | max:245',
        'account' => 'sometimes',
        'password2' => 'required_if:account,on',

    ];
    public function discountForm()
    {
        $discount_code = discountCode::where('status', 1)->where('code', $this->code)->first();
        $this->discount_code = $discount_code;
        if ($discount_code) {
            if ($discount_code->created_at < $discount_code->date) {
                if ($discount_code->price != null) {
                    $orders = $this->sum_price_order;
                    $this->discount_price = $orders - $discount_code->price;
                    $this->emit('toast', 'success', 'کد تخفیف با موفقیت اعمال شد!');
                    $orders = order::where('order_count', $this->order)->get();
                    foreach ($orders as $order) {
                        $order->update([
                            'discount_code' => $discount_code->code,
                            'discount_price' => $discount_code->price
                        ]);
                    }
                } elseif ($discount_code->percent != null) {
                    $orders = $this->sum_price_order;
                    $this->discount_percent = $orders / 100 * (100 - $discount_code->percent);
                    $this->emit('toast', 'success', 'کد تخفیف با موفقیت اعمال شد!');
                    $orders = order::where('order_count', $this->order)->get();
                    foreach ($orders as $order) {
                        $order->update([
                            'discount_code' => $discount_code->code,
                            'discount_percent' => $discount_code->percent

                        ]);
                    }
                }
            } else {
                $this->emit('toast', 'warning', 'کد تخفیف اشتباه است!');
            }
        } else {
            $this->emit('toast', 'warning', 'کد تخفیف اشتباه است!');
        }
    }
    // public function loginForm()
    // {
    //     $this->validate([
    //         'emailLogin'=>'required | email',
    //         'passwordLogin'=>'required'
    //     ]);
    //     $email = User::where('email', $this->emailLogin)->first();
    //     if ($email) {
    //         if (Hash::check($this->passwordLogin, $email->password)) {
    //             auth()->loginUsingId($email->id);
    //             $orders = order::where('order_count', $this->order)->get();
    //             foreach ($orders as $order) {
    //                 $order->update([
    //                     'user_id' => auth()->user()->id
    //                 ]);
    //             }

    //             $this->emit('toast', 'success', 'وارد شدید');
    //         } else {
    //             $this->emit('toast', 'warning', 'اطلاعات وارد شده صحیح نمی باشد');
    //         }
    //     } else {
    //         $this->emit('toast', 'warning', 'اطلاعات وارد شده صحیح نمی باشد');
    //     }
    // }
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function payment($order_count)
    {

        $this->validate([

            'payment.name' => 'required | alpha_spaces | max:20',
            'payment.lname' => 'required | alpha_spaces | max:25',
            'payment.state' => 'required | alpha_spaces | max:20',
            'payment.city' => 'required | alpha_spaces | max:25',
            'payment.address' => 'required | alpha_spaces | max:130',
            'payment.address2' => 'nullable | alpha_spaces |max:50',
            'payment.postal_code' => 'required | alpha_num | max:10 | min:10',
            'payment.email' => 'required | email',
            'payment.phone' => 'required | regex:/^09\d{9}$/',
            'payment.info' => 'nullable | max:245',
            'account' => 'sometimes',
            'password2' => 'required_with:account,on',
            // 'payment.phone'=>'required_with:account,on | unique:users,number',
            // 'payment.email'=>'required_with:account,on | unique:users,email'
        ]);
        $orders = order::where('order_count', $order_count)->get();
        if ($this->account) {
            $user = User::query()->create([
                'name' => $this->payment->name,
                'number' => $this->payment->phone,
                'email' => $this->payment->email,
                'password' => Hash::make($this->password2),
            ]);
            auth()->loginUsingId($user->id);
            foreach ($orders as $order) {
                $order->update([
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        if (auth()->user()) {
            foreach ($orders as $order) {
                $payment = payment::query()->create([
                    'ip' => Request::ip(),
                    'user_id' => auth()->user()->id,
                    'product_id' => $order->product_id,
                    'type'=>$order->type,
                    'discount_code' => $order->discount_code ?? null,
                    'discount_price' => $order->discount_price ?? null,
                    'discount_percent' => $order->discount_percent ?? null,
                    'product_price' => $order->product_price,
                    'total_price' => $order->price,
                    'count' => $order->count,
                    'order_number' => $order->order_count,
                    'color_id' => $order->color_id,
                    'size_id' => $order->size_id,
                    'order_id' => $order->id,
                    'name' => $this->payment->name,
                    'lname' => $this->payment->lname,
                    'state' => $this->payment->state,
                    'city' => $this->payment->city,
                    'address' => $this->payment->address,
                    'address_two' => $this->payment->address2 ?? null,
                    'postal_code' => $this->payment->postal_code,
                    'phone' => $this->payment->phone,
                    'email' => $this->payment->email,
                    'info' => $this->payment->info,
                ]);
            }

            if ($this->discount_code) {
                if ($this->discount_code->price != null) {
                    $price = $this->sum_price_order - $this->discount_code->price;
                } elseif ($this->discount_code->percent != null) {
                    $price = $this->sum_price_order / 100 * (100 - $this->discount_code->percent);
                }
            } else {
                $price = $this->sum_price_order;
            }

            $paymentBank = bankPayment::query()->create([
                'ip' => Request::ip(),
                'price' => $price,
                'order_number' => $order_count,
                'user_id' => auth()->user()->id,
                'payment_id' => $payment->id,

            ]);
            return redirect()->route('bank.payment.index', $order_count);
        } else {
            $this->emit('toast', 'warning', 'برای پرداخت وارد سایت شوید');
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


    public function render()
    {
        $orders = order::where('order_count', $this->order)->get();
        $userIp = Request::ip();
        if (auth()->user()) {
            $carts = cart::where('user_id', auth()->user()->id)->where('status',0)->get();
        } else {
            $session_cart = Session::get('cart');
            if(!empty($session_cart)){
                $carts = $session_cart;
            }else{
                $carts = null;
            }

        }
        $order2 = order::where('order_count', $this->order)->get();
        $order_last = $order2->last();
        $order_count = $order2->last()->order_count;


        SEOMeta::setTitle('صفحه چرداخت');
        $description = footerTitle::get();
        SEOMeta::setDescription($description[5]->title);
        OpenGraph::setDescription($description[5]->title);
        OpenGraph::setTitle('صفحه چرداخت' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::addProperty('locale:alternate', ['fa_IR']);
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        $logo = logoSite::first();
        OpenGraph::addImage('https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img);
        OpenGraph::addImage(['url' => 'http://'.$_SERVER['HTTP_HOST'].'/uploads/'.$logo->img]);
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        return view('livewire.home.order.index', compact('carts', 'orders', 'order_count'))->layout('layouts.product');
    }
}
