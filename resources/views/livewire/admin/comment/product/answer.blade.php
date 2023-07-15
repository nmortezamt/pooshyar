@section('title', 'نمایش نظر')
<div>
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="{{ route('comment.product.index') }}"></a>
                    <div>
                        <p class="comment-name"><a>محصول:{{ $comment->product->title }}</a></p>
                    </div>
                </div>
            </div>
            <div class="transition-comment">
                <div class="transition-comment-header">
                    @if($comment->user->img)
                    <span>
                        <img src="/uploads/{{ $comment->user->img }}" class="logo-pic">
                    </span>
                    @else
                    <img src="{{ asset('panel/img/pro.jpg') }}" class="logo-pic">
                    @endif
                    <span class="nav-comment-status">
                        <p class="username">کاربر : {{ $comment->user->name}}</p>
                        <p class="comment-date">{{ $comment->created_at->diffForHumans() }}</p>
                    </span>
                    <div>

                    </div>
                </div>
                <div class="transition-comment-body">
                    <p style="margin-right: 15px">
                        {{ $comment->comment }}
                    </p>
                    <div>

                    </div>
                </div>
            </div>
            <br>
            @if($comment->answer != null)
            <div class="transition-comment is-answer">
                <div class="transition-comment-header">
                    <span class="nav-comment-status">
                        <h3 class="username">مدیر</h3>
                        <p class="comment-date">{{ $comment->answer->created_at->diffForHumans() }}</p>
                    </span>
                    <div>

                    </div>
                </div>
                <div class="transition-comment-body">
                    <div style="margin-right: 15px">
                        {{ $comment->answer->body }}
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            @endif

        </div>
        @if(!$comment->answer)

        @if($comment->status == 1 )
        <div class="answer-comment">
            <p class="p-answer-comment">ارسال پاسخ</p>
            <form wire:submit.prevent='answerForm'>
                <textarea class="textarea" placeholder="متن پاسخ نظر" wire:model.lazy='commentAnswer.body'></textarea>
                <button class="btn btn-brand">ارسال پاسخ</button>
            </form>
        </div>
        @else
        <div class="answer-comment">برای پاسخ دادن، وضعیت این کامنت را تایید کنید</div>
        @endif
        @else
        <div class="answer-comment">به این کامنت قبلا جواب داده شده است</div>
        @endif
    </div>
</div>
