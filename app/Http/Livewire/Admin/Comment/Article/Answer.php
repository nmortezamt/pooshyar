<?php

namespace App\Http\Livewire\Admin\Comment\Article;

use App\Models\answerCommentArticle;
use App\Models\commentArticle;
use App\Models\log;
use Livewire\Component;

class Answer extends Component
{
    public answerCommentArticle $commentAnswer;
    public commentArticle $comment;

    public function mount()
    {
        $this->commentAnswer = new answerCommentArticle();
    }

    protected $rules = [
        'commentAnswer.body' => 'required',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    public function answerForm()
    {
        $this->validate();
        $comment = answerCommentArticle::query()->create([
            'body' => $this->commentAnswer->body,
            'article_id' => $this->comment->article_id,
            'comment_id' => $this->comment->id,
        ]);

        $this->emit('toast', 'success', ' جواب به کامنت با موفقیت اضافه شد');
        $this->commentAnswer->body = "";

        log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن جواب به کامنت' . ' :' . $comment->name,
            'actionType' => 'ایجاد'
        ]);
    }

    public function render()
    {

        $comment = $this->comment;
        return view('livewire.admin.comment.article.answer',compact('comment'));
    }
}
