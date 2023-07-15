<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $image;
    public User $user;
    protected $rules = [
        'user.name' => 'required | max:30',
        'user.email' => 'required | email |max:30',
        'user.number' => 'required | max:11 | min:11',
        'user.password1' => 'required | max:30 | min:6',
        'user.admin' => 'nullable',
        'user.staff' => 'nullable',
        'image' => 'nullable'
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->user = new user();
    }

    public function user()
    {
        $this->validate();
        $user = user::query()->create([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'number' => $this->user->number,
            'password' => Hash::make($this->user->password1),
            'admin' => $this->user->admin ? 1 : 0,
            'staff' => $this->user->staff ? 1 : 0,
        ]);
        if ($this->image) {
            $user->update([
                'img' => $this->images()
            ]);
        }
        alert()->success('موفقیت', 'کاربر با موفقیت ایجاد شد')->showConfirmButton('باشه', '#3085d6');
        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن کاربر' . ' :' . $user->name,
            'actionType' => 'ایجاد'
        ]);
        return redirect()->route('users.index');
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
        return view('livewire.admin.users.create');
    }
}
