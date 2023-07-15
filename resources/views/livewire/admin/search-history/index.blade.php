<div>
    @section('title',' تاریخچه جستجوها')
<div>
    <div class="main-content" wire:init='loadSearch'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('search.history.index') }}">تاریخچه جستجوها</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی متن جستجوها ">
            </div>
            </form>
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>متن جستجو</th>
                    <th>کاربر</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($search_histories as $search)
                <tr role="row">
                    <td>{{ $search->id }}</td>
                    <td>{{ $search->text_search }}</td>
                    <td>
                        @if($search->user_id)
                        {{ $search->user->name ?? $search->user->id}}
                        @else
                        <div>خالی</div>
                        @endif
                    </td>

                    <td>{{ jdate($search->created_at)->format('%Y/%m/%d') }}</td>

                </tr>
                @empty
                <div>جستجویی وجود ندارد</div>
                @endforelse
                {{ $search_histories->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
