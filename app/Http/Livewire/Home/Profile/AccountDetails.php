<?php

namespace App\Http\Livewire\Home\Profile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\User\Models\User;

class AccountDetails extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $pass;
    public $image;
    public $newpass;
    public $newrepass;

    //

    public $currectpass;
    public $passedit;
    public $repass;



    public function editName(){
        $this->validate(['name'=>'required | alpha | max:30']);
        $user = User::where('id',auth()->user()->id)->first();
        $user->update([
            'name'=>$this->name
        ]);
        $this->emit('toast', 'success', 'نام با موفقیت ویرایش شد');


    }
    public function editEmail(){
        $user = User::where('id',auth()->user()->id)->first();

        $this->validate(['email'=>"required | email | unique:users,email"]);
        $user = User::where('id',auth()->user()->id)->first();
        $user->update([
            'email'=>$this->email
        ]);
        $this->emit('toast', 'success', 'ایمیل با موفقیت ویرایش شد');


    }
    public function createPassword(){
        $user = User::where('id',auth()->user()->id)->first();
        $this->validate(['newpass'=>"required| min:8" , "newrepass"=>" same:newpass"]);
            if($this->newrepass == $this->newpass){
                $user->update([
                    'password'=> Hash::make($this->newrepass)
                ]);
            $this->emit('toast', 'success', 'رمز عبور با موفقیت ویرایش شد');

            }
    }
    public function editPassword(){
        $user = User::where('id',auth()->user()->id)->first();

        $this->validate(['currectpass'=>"required| min:8"]);
            if(Hash::check($this->currectpass,$user->password)){
        $this->validate(['passedit'=>"required|min:8","repass"=>'same:passedit']);

                if($this->passedit == $this->repass){
                    $user->update([
                        'password'=> Hash::make($this->repass)
                    ]);
                $this->emit('toast', 'success', 'رمز عبور با موفقیت ویرایش شد');

                }

            }else{
                $this->emit('toast', 'warning', 'رمز عبور فعلی اشتباه است');
            }
    }
        public function editImage(){
        $this->validate(['image'=>"required | image | max:4000"]);

        $user = User::where('id',auth()->user()->id)->first();
        if ($this->image) {
            if($user->img)
            {
                Storage::disk('public')->delete('uploads',$user->img);
            }
            $user->update([
                'img'=>$this->images()
            ]);
        }
        $this->emit('toast', 'success', 'عکس با موفقیت ویرایش شد');

    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "users/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }
    public function render()
    {
        $user = User::where('id',auth()->user()->id)->first();
        return view('livewire.home.profile.account-details',compact('user'))->layout('layouts.profile');
    }
}
