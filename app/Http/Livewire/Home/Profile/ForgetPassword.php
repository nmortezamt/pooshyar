<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\smsCode;
use Exception;
use Livewire\Component;
use Melipayamak;
use Modules\User\Models\User;

class ForgetPassword extends Component
{
    public $phone;
    protected $rules = [
        'phone'=> 'required | regex:/^0[0-9]{10}$/',
    ];
    public function updatePassword()
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
                return redirect()->route('profile.verify.phone');
                echo $json->Value;

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }else{
            $this->emit('toast', 'warning', 'برای بازیابی رمز عبور لازم است شماره همراه مربوط به همین حساب کاربری را وارد نمایید.');
        }
    }
    public function render()
    {
        return view('livewire.home.profile.forget-password')->layout('layouts.login');
    }
}
