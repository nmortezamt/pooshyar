@section('title','کامنت های مقاله')
<div>
    <div class="main-content" wire:init='loadComment'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('comment.article.index') }}">کامنت های مقالات </a>
                <a class="tab__item"
                    href="{{ route('comment.product.index') }}">کامنت های محصولات</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی کامنت ">
            </div>
            </form>
            </a>
        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر کاربر</th>
                                <th>مقاله</th>
                                <th>نام کاربر</th>
                                <th> ایمیل کاربر</th>
                                <th>نظر کاربر</th>
                                <th>وضیعت کامنت</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($comments as $comment)
                            <tr role="row">
                                <td>{{ $comment->id }}</td>
                                <td>
                                    {{-- @if ($comment->img)
                                    <img src="/uploads/{{ $category->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif --}}
                                </td>
                                <td>{{ $comment->article->title }}</td>
                                <td>{{ $comment->name ?? $comment->user->name}}</td>
                                <td>{{ $comment->email ?? $comment->user->email}}</td>
                                <td>{{ Str::limit($comment->comment, 50, '...') }}</td>
                                <td>
                                    @if ($comment->status==1)
                                    <button wire:click="updateCategorydisable({{ $comment->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $comment->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>{{ jdate($comment->created_at)->format('%B %d, %Y') }}</td>
                                <td>
                                    <button wire:click='remove({{ $comment->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                        <a href="{{ route('comment.article.answer',$comment) }}" class="item-eye"
                                        title="نمایش و جواب دادن"></a>
                                </td>
                            </tr>
                            @empty
                            <div>کامنتی وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        {{ $comments->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

