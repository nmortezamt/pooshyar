<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\article;
use App\Models\log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;
    public $image;
    public $body;
    public article $article;
    protected $rules = [
        'article.title' => 'required | string | max:100',
        'article.link' => 'required | string | max:100',
        'article.description' => 'required | max:180',
        'article.keyword' => 'required | max:120',
        'article.category_article_id' => 'required',
        'article.subcategory_article_id' => 'required',
        'body' => 'required',
        'image' => 'required | image | max:9000',
        'article.status' => 'nullable',
    ];
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount()
    {
        $this->article = new article();
    }
    public function article()
    {
        $this->validate();
        $article = article::query()->create([
            'title' => $this->article->title,
            'link' => Str::slug($this->article->link),
            'description' => $this->article->description,
            'keyword' => $this->article->keyword,
            'category_article_id' => $this->article->category_article_id,
            'subcategory_article_id' => $this->article->subcategory_article_id,
            'body' => $this->body,
            'status' => $this->article->status ? 1 : 0
        ]);
        if ($this->image) {
            $article->update([
                'img' => $this->images()
            ]);
        }

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن مقاله' . ' :' . $article->title,
            'actionType' => 'ایجاد'
        ]);
        alert()->success('موفقیت', 'مقاله با موفقیت ایجاد شد')->showConfirmButton('باشه', '#3085d6');
        return redirect()->route('article.index');
    }

    public function images()
    {
        $year = now()->year;
        $month = now()->month;
        $directory = "article/$year/$month";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return "$directory/$name";
    }
    public function render()
    {
        return view('livewire.admin.article.create');
    }
}
