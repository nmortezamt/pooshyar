<?php

namespace App\Http\Livewire\Home\Users;

use App\Models\cart;
use App\Models\smsCode;
use App\Models\User;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Melipayamak;


class VerifyPhone extends Component
{
    public $code;
    protected $rules = [
        'code'=> 'required | min:5 | max:5',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        if(auth()->user()){
            return redirect()->route('profile.index');
        }
    }

    public function login()
    {
        $this->validate();
        $time = new Carbon();
        $sms = smsCode::where('code',$this->code)->where('created_at','>',$time->subMinutes(4))->first();
        if($sms){
            auth()->loginUsingId($sms->user->id);
            $user = User::where('id',$sms->user->id)->first();
            $user->update([
                'active'=>now(),
            ]);
                $sessionCart = Session::get('cart');
                if(!empty($sessionCart)){
                    foreach ($sessionCart as $cart) {
                        $ModelCart = cart::where('id',$cart['id'])->get();
                        foreach($ModelCart as $Mcart){
                            $Mcart->update([
                                'user_id'=>auth()->user()->id
                            ]);
                        }
                    }
                }
                $hasUrl = Session::get('url');
                if(! empty($hasUrl)){
                    return redirect($hasUrl);
                }
            return redirect('/');
        }else{
            $this->emit('toast', 'warning', 'کد وارد شده اشتباه است!');
        }
    }

    public function resendCode($id)
    {

        $phone = User::where('id',$id)->first();
        try{
            $code = random_int(10000,99999);
            $sms = Melipayamak::sms();
            $to = $phone->number;
            $from = env('PHONE_MELIPYAMAK');
            $text = "پوشیار".PHP_EOL."کد تایید: $code";
            $response = $sms->send($to,$from,$text);
            $json = json_decode($response);
            smsCode::query()->create([
                'code'=>$code,
                'user_id'=>$phone->id,
            ]);
            return redirect(request()->header('referer'));
            echo $json->Value;

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function render()
    {
        $phone = smsCode::get()->last();

        SEOMeta::setTitle('تایید کد');
        OpenGraph::setTitle('تایید کد' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        return view('livewire.home.users.verify-phone',compact('phone'))->layout('layouts.login');
    }
}
