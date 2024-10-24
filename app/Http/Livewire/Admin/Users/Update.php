<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\User\Models\User;

class Update extends Component
{
    use WithFileUploads;
    public $image;
    public User $user;
    protected $rules = [
        'user.name' => 'required | max:30',
        'user.email' => 'required | email |max:30',
        'user.number' => 'required | max:11 | min:11',
        'user.admin' => 'nullable',
        'user.staff' => 'nullable',
        'image' => 'nullable'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function user()
    {
        $this->validate();
        if ($this->image) {
            if($this->user->img)
            {
                Storage::disk('public')->delete('uploads',$this->user->img);
            }
            $this->user->img = $this->images();
        }
        $this->user->update([
            'name' =>$this->user->name,
            'email' =>$this->user->email,
            'number' =>$this->user->number,
            'admin' =>$this->user->admin ? 1 : 0,
            'staff' =>$this->user->staff ? 1 : 0
        ]);

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش کاربر' . ' ' . $this->user->name,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'کاربر با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
        return redirect(route('users.index'));
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
        if ($this->user->admin == 1) {
            $this->user->admin = true;
        } else {
            $this->user->admin = false;
        }

        if ($this->user->staff == 1) {
            $this->user->staff = true;
        } else {
            $this->user->staff = false;
        }

        $user = $this->user;
        return view('livewire.admin.users.update',compact('user'));
    }
}
