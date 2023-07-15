<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
    <div class="comments">
        <h5 class="product_tab_title">{{\App\Models\persianNumber::translate( $countComment )}} دیدگاه برای محصول_<span>{{ $product->title }}</span></h5>
        <ul class="list_none comment_list mt-4">
            @forelse ($comments as $comment)
            <li class="list_none_commentp">
                @if ($comment->user->img)
                <div class="comment_img">
                    <img src="/uploads/{{ $comment->user->img }}" alt="user">
                </div>
                @else
                <div class="comment_img">
                    <img src="{{ asset('pooshyar/assets/images/user_comment.png') }}" alt="user">
                </div>
                @endif

                <div class="comment_block">
                    <div class="rating_wrap">
                        <div class="rating">
                            <div class="product_rate" style="width:{{ $comment->rate*20 }}%"></div>
                        </div>
                    </div>
                    <p class="customer_meta">
                        <span class="review_author">{{ $comment->user->name }}</span>
                        <span class="comment-date">{{\App\Models\persianNumber::translate( jdate($comment->user->created_at)->format('%B %d ,%Y') )}}</span>
                    </p>
                    <div class="description">
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
            </li>

            @if($comment->answer)
            <ul class="children_product">
                <li class="comment_info list_none_commentp">
                    <div class="d-flex">
                        <div class="comment_user">
                            <img src="{{asset('pooshyar/assets/images/support.png')}}" alt="پشتیبانی">
                        </div>
                        <div class="comment_content">
                            <div class="d-flex align-items-md-center">
                                <div class="meta_data">
                                    <h6><a>پشتیبانی</a></h6>
                                    <div class="comment-time">{{ jdate($comment->answer->created_at)->format('%B %d,%Y') }}</div>
                                </div>
                            </div>
                            <p>{{ $comment->answer->body }}</p>
                        </div>
                    </div>
                    <hr>
                </li>
            </ul>
            @endif
        </ul>
        @empty
        @endforelse
    </div>
    <br>
    <div class="review_form field_form">
        <h5>نظرتان را بنویسید</h5>
        <form class="row mt-3" wire:submit.prevent='commentForm'>
            <div class="form-group col-12">
                <div class="star_rating">
                    <span data-value="1" wire:click="rate({{ 1 }})">
                        <i class="far fa-star"></i></span>
                    <span data-value="2" wire:click="rate({{ 2 }})"><i class="far fa-star">
                        </i></span>
                    <span data-value="3" wire:click="rate({{ 3 }})"><i class="far fa-star"></i></span>

                    <span data-value="4" wire:click="rate({{ 4 }})"><i class="far fa-star"></i></span>

                    <span data-value="5" wire:click="rate({{ 5 }})"><i class="far fa-star">
                        </i></span>
                </div>
            </div>
            <div class="form-group col-12">
                <textarea required="required" placeholder="نظر شما *" class="form-control" name="message" rows="4"
                    wire:model.lazy='comment.comment'></textarea>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">ارسال دیدگاه</button>
                <div wire:loading wire:target="commentForm">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </div>
        </form>
    </div>
</div>
