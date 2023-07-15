<?php

namespace App\Http\Controllers;

use App\Models\newletter;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;


class Postcontroller extends Controller
{
    public function newletter(Request $request)
    {
        $newsletter = newletter::where('email',$request->email)->first();
        if(isset($newsletter)){
        alert()->warning('خطا', 'قبلا ایمیل شما در خبرنامه ثبت شده است')->showConfirmButton('باشه', '#3085d6');
        return back()->withFragment('footer');
        }else{
            newletter::create([
                'email'=>$request->email
            ]);
            alert()->success('موفقیت', 'ایمیل شما با موفقیت در خبرنامه ثبت شد')->showConfirmButton('باشه', '#3085d6');
        }
        return back()->withFragment('footer');
    }
}
