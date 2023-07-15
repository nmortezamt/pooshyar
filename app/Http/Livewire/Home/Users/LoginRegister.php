<?php

namespace App\Http\Livewire\Home\Users;

use App\Models\smsCode;
use App\Models\User;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Exception;
use Melipayamak;
use Livewire\Component;

class LoginRegister extends Component
{
    public $phone;
    protected $rules = [
        'phone'=> 'required | regex:/^09\d{9}$/',
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
        $phone = User::where('number',$this->phone)->first();
        if($phone){

            try{
                $code = random_int(10000,99999);
                $sms = Melipayamak::sms();
                $to = $this->phone;
                $from = env('PHONE_MELIPYAMAK');
                $text = "پوشیار".PHP_EOL."کد تایید: $code";
                $response = $sms->send($to,$from,$text);
                $json = json_decode($response);
                smsCode::query()->create([
                    'code'=>$code,
                    'user_id'=>$phone->id,
                ]);
                return redirect()->route('login.verify.phone');
                echo $json->Value;

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }else{
            $phone = User::query()->create(['number'=>$this->phone]);
            try{
                $code = random_int(10000,99999);
                $sms = Melipayamak::sms();
                $to = $this->phone;
                $from = env('PHONE_MELIPYAMAK');
                $text = "پوشیار".PHP_EOL."کد تایید: $code";
                $response = $sms->send($to,$from,$text);
                $json = json_decode($response);
                smsCode::query()->create([
                    'code'=>$code,
                    'user_id'=>$phone->id
                ]);
                return redirect()->route('login.verify.phone');
                echo $json->Value;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
    public function render()
    {

        SEOMeta::setTitle('ورود به سایت');
        OpenGraph::setTitle('ورود به سایت' .' - پوشیار');
        OpenGraph::setUrl('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'fa_IR');
        OpenGraph::setSiteName('تولید و پخش تونیک زنانه - پوشیار');
        SEOMeta::setCanonical('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        SEOMeta::setRobots('index,follow');

        return view('livewire.home.users.login-register')->layout('layouts.login');
    }
}
