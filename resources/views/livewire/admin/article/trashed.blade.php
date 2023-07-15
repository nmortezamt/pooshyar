<div>
@section('title','سطل زباله مقالات')
    <div class="main-content" wire:init='loadArticle'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('article.index') }}">لیست مقالات</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <a class="tab__item btn-sm btn-danger text-white"
            style="margin-top:-90px; float:left;"
            href="{{ route('article.index') }}">
             برگشت
            </a>
        </div>

        <div class="table__box">
            <table class="table table-bordered">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>عکس مقاله</th>
                    <th>عنوان</th>
                    <th>دسته بندی</th>
                    <th>لینک</th>
                    <th>تعداد بازدید ها</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($articles as $article)
                <tr role="row" class="">
                    <td>{{ $article->id }}</td>
                    <td>
                        <img src="{{asset('uploads/'.$article->img )}}" alt="{{ $article->title }}" width="70px">
                    </td>
                    <td><a>{{ $article->title }}</a></td>
                    <td>
                        _دسته
                        @foreach (\App\Models\category::where('id',$article->category_id)->get() as $category)
                            {{ $category->title }}
                        @endforeach
                        <br>
                        _زیر دسته
                        @foreach (\App\Models\subcategory::where('id',$article->subcategory_id)->get() as $subcategory)
                        {{ $subcategory->title }}
                        @endforeach
                    </td>
                    <td>{{ $article->link }}</td>
                    <td>{{ $article->view ? $article->view : 0}}</td>
                    <td>{{ jdate($article->created_at)->format('%Y/%m/%d') }}</td>
                    <td>
                        <a wire:click='remove({{ $article->id }})' class="item-delete mlg-15"
                            title="حذف"></a>

                       <a wire:click='restorearticle({{ $article->id }})' class="item-li i-checkouts item-restore"> </a>
                    </td>
                </tr>
                @empty
                <div>مقاله ای وجود ندارد</div>
                @endforelse
             {{ $articles->links() }}

                </tbody>
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
            </table>
        </div>
    </div></div>
