<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\User;

class updateAccount extends Controller
{
    public function update($id , Request $request)
    {
        $user = User::find($id);

        if($request->name){
            $user->update([
                'name'=>$request->name
            ]);
        }

        if($request->email){
            $user->update([
                'email'=>$request->email
            ]);
        }

        if($request->phone){
            $user->update([
                'number'=>$request->phone
            ]);
        }

        if($request->currentpassword){
            $user->update([
                'password'=>$request->currentpassword
            ]);
        }

        return back();

    }
}
