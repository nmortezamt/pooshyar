@section('title',' سطل زباله صفحات سایت')

<div>
    <div class="main-content" wire:init='loadPage'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('page.index') }}">صفحات سایت </a>
                <a class="t-header-search">
            </div>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
            href="{{ route('page.index') }}">
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
                                <th> تصویر صفحه سایت</th>
                                <th>عنوان صفحه سایت</th>
                                <th>لینک صفحه سایت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($pages as $page)
                            <tr role="row">
                                <td>{{ $page->id }}</td>
                                <td>
                                    @if($page->img)
                                    <img src="/uploads/{{ $page->img }}" alt="img" width="50" height="50">
                                    @else
                                    <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $page->title }}</td>
                                <td><a href="{{ url($page->link) }}">{{ $page->link }}</a></td>
                                <td>
                                    <button wire:click='remove({{ $page->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                        <a wire:click='restorepage({{ $page->id }})' class="item-li i-checkouts item-restore"> </a>
                                </td>
                            </tr>
                            @empty
                            <div>صفحه ای وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $pages->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
