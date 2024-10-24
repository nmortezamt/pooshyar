<?php

namespace App\Http\Controllers\panel\permission;

use App\Http\Controllers\Controller;
use App\Models\permissionUser;
use Illuminate\Http\Request;
use Modules\User\Models\User;

class index extends Controller
{
    public function create($id , Request $request)
    {
        $permissionUser = permissionUser::where('user_id',$id)->first();
        if($permissionUser){
            permissionUser::where('user_id',$id)->delete();
        }
        $permission_id = $request->permission;
        if($permission_id){
        foreach($permission_id as $value){
            permissionUser::query()->create([
                'permission_id'=>$value,
                'user_id'=>$id,
            ]);
        }
        }else{
            // alert()->error('خطا',"باید دسترسی رو انتخاب کنید")->showConfirmButton('باشه', '#3085d6');
            // return back();
        }

        $user = User::find($id);
        $name = $user->name;
        alert()->success('موفقیت',"دسترسی به کاربر $name با موفقیت انجام شد")->showConfirmButton('باشه', '#3085d6');
        return redirect()->route('users.index');
    }
    public function render($id)
    {
        $user = User::find($id);
        return view('livewire.admin.users.permission-user',compact('user'));
    }
}
