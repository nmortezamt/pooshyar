<?php

namespace App\Http\Livewire\Admin\Article;

use Livewire\Component;
use Modules\Blog\Models\blog;

class View extends Component
{
    public blog $article;

    public function render()
    {
        $article = $this->article;

        return view('livewire.admin.article.view',compact('article'));
    }
}
