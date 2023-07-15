<div class="comment-area" id="comment">
    <div class="content_title">
        <h5>دیدگاه ({{\App\Models\persianNumber::translate($comments)}}) </h5>
    </div>
    <ul class="list_none comment_list">
        <li class="comment_info">
            @forelse (\App\Models\commentArticle::where([['status',1],['article_id',$article->id]])->get() as $comment)
            <div wire:key="{{ $comment->id }}" class="d-flex">
                @if($comment->user)
                @if($comment->user->img)
                <div class="comment_user">
                    <img src="/uploads/{{ $comment->user->img }}" alt="user">
               </div>
               @else
               <div class="comment_user">
                <img src="{{ asset('pooshyar/assets/images/user_comment.png') }}" alt="user2">
              </div>
                @endif
                @else
                <div class="comment_user">
                    <img src="{{ asset('pooshyar/assets/images/user_comment.png') }}" alt="user2">
               </div>
                @endif

                <div class="comment_content">
                    <div class="d-flex">
                        <div class="meta_data">
                            <h6><a>{{ $comment->name ?? $comment->user->name}}</a></h6>
                            <div class="comment-time">
                                {{\App\Models\persianNumber::translate( jdate($comment->created_at)->format('%B %d ,%Y'))}}
                            </div>
                        </div>

                    </div>
                    <p>{{ $comment->comment }}</p>
                </div>
            </div>

            @if($comment->answer)
            <ul class="children">
                <li class="comment_info">
                    <div class="d-flex">
                        <div class="comment_user">
                            <img src="{{asset('pooshyar/assets/images/support.png')}}" alt="support">
                        </div>
                        <div class="comment_content">
                            <div class="d-flex align-items-md-center">
                                <div class="meta_data">
                                    <h6><a>پشتیبانی</a></h6>
                                    <div class="comment-time">{{ \App\Models\persianNumber::translate(jdate($comment->answer->created_at)->format('%B %d ,%Y'))  }}</div>
                                </div>

                            </div>
                            <p>{{ $comment->answer->body }}
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
            <hr>
            @else
            <hr>
            @endif
            @empty
            @endforelse
        </li>
    </ul>
    <div class="content_title">
        <h5>دیدگاهتان را بنویسید</h5>
    </div>
    @if(auth()->user())
    <form class="field_form" wire:submit.prevent='commentFormAuth'>
        <div class="row">
            <div class="form-group col-md-12">
                <textarea rows="3" name="message" class="form-control" placeholder="نظر شما" required="required" wire:model.lazy='comment.comment'></textarea>
                @error('comment.comment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <button value="Submit" name="submit" class="btn btn-fill-out"
                    title="پیام خود را ارسال کنید!" type="submit">ارسال</button>
            </div>
        </div>
    </form>
    @else
        <form class="field_form" wire:submit.prevent='commentForm'>
        <div class="row">
            <div class="form-group col-md-4">
                <input name="name" class="form-control" placeholder="نام شما"
                    required="required" type="text" wire:model.lazy='comment.name'>
                    @error('comment.name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group col-md-4">
                <input name="email" class="form-control" placeholder="ایمیل شما"
                    required="required" type="email" wire:model.lazy='comment.email'>
                    @error('comment.email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group col-md-12">
                <textarea rows="3" name="message" class="form-control" placeholder="نظر شما" required="required" wire:model.lazy='comment.comment'></textarea>
                @error('comment.comment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <button value="Submit" name="submit" class="btn btn-fill-out"
                    title="پیام خود را ارسال کنید!" type="submit">ارسال</button>
                    <div wire:loading wire:target="commentForm">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
            </div>
        </div>
    </form>
    @endif

</div>
