<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\favorite as ModelsFavorite;
use Livewire\Component;

class Favorite extends Component
{
    public $deleted = false;

    public function removeFavorite($id)
    {
        if (!$this->deleted) {
        $favorite = ModelsFavorite::findOrFail($id);
        $favorite->delete();
        $this->deleted = true;
        }
    }
    public function render()
    {
        $favorites = ModelsFavorite::where('user_id',auth()->user()->id)->get();
        return view('livewire.home.profile.favorite',compact('favorites'))->layout('layouts.profile');
    }
}
