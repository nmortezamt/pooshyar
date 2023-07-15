<?php

namespace App\Http\Livewire\Home\Profile;

use App\Models\commentArticle;
use App\Models\commentProduct;
use Livewire\Component;

class Comment extends Component
{

    public function removeCommentArticle($id)
    {
        $comment = commentArticle::find($id);
        if (isset($comment)) {
            $comment = commentArticle::find($id);
            $comment->delete();
        }
    }

    public function removeCommentProduct($id)
    {
        $comment = commentProduct::find($id);
        if (isset($comment)) {
            $comment = commentProduct::find($id);
            $comment->delete();
        }
    }

    public function render()
    {
        $comment_product = commentProduct::where('user_id', auth()->user()->id)->get();
        $comment_article = commentArticle::where('user_id', auth()->user()->id)->get();
        return view('livewire.home.profile.comment', compact('comment_product', 'comment_article'))->layout('layouts.profile');
    }
}
