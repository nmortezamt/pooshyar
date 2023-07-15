<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\article;
use Livewire\Component;

class View extends Component
{
    public article $article;

    public function render()
    {
        $article = $this->article;

        return view('livewire.admin.article.view',compact('article'));
    }
}
