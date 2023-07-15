@section('title',' سطل زباله دسته مقالات')

<div>
    <div class="main-content" wire:init='loadCategory'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('category.article.index') }}">دسته های مقالات </a>
                <a class="tab__item"
                    href="{{ route('subcategory.article.index') }}">زیر دسته مقالات</a>
            <a class="tab__item btn btn-danger text-white" style="margin-left:10px; float:left;"
            href="{{ route('category.article.index') }}">
            برگشت
            </a>
        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>عنوان دسته </th>
                                <th>تصویر دسته</th>
                                <th>لینک دسته</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($categories as $category)
                            <tr role="row">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>
                                    @if ($category->img)
                                    <img src="/uploads/{{ $category->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $category->link }}</td>
                                <td>
                                    <a wire:click='remove({{ $category->id }})' class="item-delete mlg-15"
                                        title="حذف"></a>

                                   <a wire:click='restorecategory({{ $category->id }})' class="item-li i-checkouts item-restore"> </a>
                                </td>
                            </tr>
                            @empty
                            <div>دسته ای وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $categories->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
