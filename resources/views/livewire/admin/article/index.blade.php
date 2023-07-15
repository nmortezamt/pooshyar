@section('title',' مقالات')
<div>
    <div class="main-content" wire:init='loadArticle'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('article.index') }}">مقالات</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی مقاله ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('article.trashed') }}"
            >سطل زباله
            ({{ \App\Models\article::onlyTrashed()->count() }})
            </a>

            <a class="tab__item btn btn-success text-white" style="margin-top:-60px; margin-left:120px; float:left;"
            href="{{ route('article.create') }}">
            افزودن مقاله
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
                    <th>وضعیت مقاله</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($articles as $article)
                <tr role="row">
                    <td>{{ $article->id }}</td>
                    <td>
                        <img src="/uploads/{{$article->img}}" alt="{{ $article->title }}" width="60px">
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>
                        _دسته:
                        {{ $article->category->title }}
                     <br>
                     _زیر دسته
                     {{ $article->subcategory->title }}
                    </td>
                    <td>{{ $article->link }}</td>
                    <td>{{ $article->view ? $article->view : 0}}</td>
                    <td>{{ jdate($article->created_at)->format('%Y/%m/%d') }}</td>
                    <td>
                        @if ($article->status==1)
                        <button wire:click="updateArticledisable({{ $article->id }})"
                            class="badge-success badge" style="background-color: green">فعال
                        </button>
                        @else
                        <button wire:click="updateArticleinable({{ $article->id }})"
                            class="badge-danger badge" style="background-color: red"> غیر فعال
                        </button>
                        @endif
                    </td>
                    <td>
                        <button wire:click='remove({{ $article->id }})' href="" class="item-delete mlg-15"
                            title="حذف"></button>

                        <a href="{{ route('article.update',$article) }}" class="item-edit mlg-15"
                            title="ویرایش"></a>

                        <a href="{{ route('article.view',$article) }}" class="item-eye"
                            title="نمایش"></a>
                    </td>
                </tr>
                @empty
                <div>مقالی وجود ندارد</div>
                @endforelse
                {{ $articles->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
