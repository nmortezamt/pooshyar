<?php

namespace App\Http\Livewire\Admin\Comment\Product;

use App\Models\answerCommentProduct;
use App\Models\commentProduct;
use App\Models\log;
use Livewire\Component;

class Answer extends Component
{
    public answerCommentProduct $commentAnswer;
    public commentProduct $comment;

    public function mount()
    {
        $this->commentAnswer = new answerCommentProduct();
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
        $comment = answerCommentProduct::query()->create([
            'body' => $this->commentAnswer->body,
            'product_id' => $this->comment->product_id,
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
        return view('livewire.admin.comment.product.answer',compact('comment'));
    }
}
