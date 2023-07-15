<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditPassword extends Component
{
    public $newrepass;
    public $newpass;

    protected $rules =[
        'newpass'=> 'required | min:8',
        'newrepass'=>'same:newpass'
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function editPassword()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $this->validate();
        if($this->newpass){
            if($this->newpass == $this->newrepass){
                $user->update([
                    'password'=>Hash::make($this->newrepass)
                ]);
                alert()->success('موفقیت', 'رمز عبور با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
                return redirect(route('profile.details'));
            }
        }
    }
    public function render()
    {
     
    
        return view('livewire.home.profile.edit-password')->layout('layouts.login');
    }
}
