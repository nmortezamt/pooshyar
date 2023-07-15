<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\smsCode;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Melipayamak;
use illuminate\Support\Str;

class VerifyCode extends Component
{

    public $code;
    protected $rules = [
        'code'=> 'required | min:5 | max:5',
    ];
    public function verifyCode()
    {
        $this->validate();
        $time = new Carbon();
        $sms = smsCode::where('code',$this->code)->where('created_at','>',$time->subMinutes(4))->first();
        if($sms){
            $random_string = Str::random(40);
            return redirect(route('profile.reset.passwordd',$random_string));
            }
        else{
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

        return view('livewire.home.profile.verify-code',compact('phone'))->layout('layouts.login');
    }
}
