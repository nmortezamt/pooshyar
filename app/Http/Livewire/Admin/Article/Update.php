<?php

namespace App\Http\Livewire\Admin\Article;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\article;
use App\Models\log;
use Illuminate\Support\Str;


class Update extends Component
{
    use WithFileUploads;
    public $image;
    public article $article;
    protected $rules = [
        'article.title' => 'required | string | max:100',
        'article.link' => 'required | string | max:100',
        'article.description' => 'required | max:180',
        'article.keyword' => 'required | max:120',
        'article.category_article_id' => 'required',
        'article.subcategory_article_id' => 'required',
        'article.body' => 'required',
        'image' => 'nullable | image | max:9000',
        'article.status' => 'nullable',
    ];
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function article()
    {
        $this->validate();
        if ($this->image) {
            Storage::disk('public')->delete('uploads',$this->article->img);
            $this->article->update([
                'img' => $this->images()
            ]);
        }
        $this->article->update([
            'title' => $this->article->title,
            'link' => Str::slug($this->article->link),
            'description' => $this->article->description,
            'keyword' => $this->article->keyword,
            'category_article_id' => $this->article->category_article_id,
            'subcategory_article_id' => $this->article->subcategory_article_id,
            'body' => $this->article->body,
            'status' => $this->article->status ? 1 : 0
        ]);

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'ویرایش مقاله' . ' :' . $this->article->title,
            'actionType' => 'آپدیت'
        ]);
        alert()->success('موفقیت', 'مقاله با موفقیت ویرایش شد')->showConfirmButton('باشه', '#3085d6');
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
        if ($this->article->status == 1) {
            $this->article->status = true;
        } else {
            $this->article->status = false;
        }
        $article = $this->article;

        return view('livewire.admin.article.update',compact('article'));
    }
}
