<div>
    @section('profile','دیدگاه | پروفایل - پوشیار')
    <div class="tab-pane" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h3>دیدگاه های محصولات</h3>
        </div>

        @if (\App\Models\commentProduct::where('user_id',auth()->user()->id)->first())

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>برای محصول</th>
                            <th>دیدگاه</th>
                            <th>امتیاز</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($comment_product as $comment)
                        <tr wire:key="{{ $comment->id }}">
                            {{-- @if ($payment->status == 0)

                            @endif --}}
                            <td><a href="{{ route('product.single.index',['id'=>$comment->product->id , 'link'=>$comment->product->link]) }}">{{ $comment->product->title }}</a></td>

                            <td>{{ $comment->comment }}</td>
                            <td>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{ $comment->rate*20 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            @if ($comment->status == 1)
                            <td class="text-success">تایید شده</td>
                            @else
                            <td class="text-danger">در انتظار تایید</td>
                            @endif

                            <td>{{ \App\Models\persianNumber::translate(jdate($comment->created_at)->format('%d  %B %Y') )}}</td>

                            <td>
                            <a wire:click='removeCommentProduct({{ $comment->id }})' class="ml-3">
                            <div wire:loading wire:target="removeCommentProduct({{ $comment->id }})">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            <span wire:loading.remove wire:target="removeCommentProduct({{ $comment->id }})">
                                <i class="ti-close"></i>
                            </span></a>
                            </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
        @else
        <h3 class="text-center">هنوز هیچ نظری ندارید</h3>
        @endif

    </div>
    <br>
    <hr style="border-color: black; border-style: 4px">
    <br>
    <div class="card">
        <div class="card-header">
            <h3>دیدگاه های وبلاگ ها</h3>
        </div>

        @if (\App\Models\commentArticle::where('user_id',auth()->user()->id)->first())

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>برای وبلاگ</th>
                            <th>دیدگاه</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($comment_article as $comment)
                        <tr>
                            {{-- @if ($payment->status == 0)

                            @endif --}}
                            <td><a href="{{ route('article.single.index',['link'=>$comment->article->link]) }}">{{ $comment->article->title }}</a></td>

                            <td>{{ $comment->comment }}</td>

                            @if ($comment->status == 1)
                            <td class="text-success">تایید شده</td>
                            @else
                            <td class="text-danger">در انتظار تایید</td>
                            @endif

                            <td>{{ \App\Models\persianNumber::translate(jdate($comment->created_at)->format('%d  %B %Y') )}}</td>

                            <td>
                            <a wire:click='removeCommentArticle({{ $comment->id }})' class="ml-3"><div wire:loading wire:target="removeCommentArticle({{ $comment->id }})">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            <span wire:loading.remove wire:target="removeCommentArticle({{ $comment->id }})">
                                <i class="ti-close"></i>
                            </span></a>
                            </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
                <hr>

            </div>
        </div>
        @else
        <h3 class="text-center">هنوز هیچ نظری ندارید</h3>
        @endif

    </div>
  </div>

</div>
