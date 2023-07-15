<div>
    @section('title',' لیست علاقه مندی ها')
<div>
    <div class="main-content" wire:init='loadFavorite'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('orders.index') }}">سفارشات</a>
                <a class="tab__item" href="{{ route('carts.admin') }}">سبد خریدها</a>
                <a class="tab__item" href="{{ route('payments.index') }}">پرداخت ها</a>
                <a class="tab__item" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
                <a class="tab__item is-active" href="{{ route('list.favorite.index') }}">علاقه مندی ها</a>
                <a class="tab__item" href="{{ route('invoices.index') }}">صورتحساب</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی علاقه مندی ">
            </div>
            </form>
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>محصول</th>
                    <th>کاربر</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($favorites as $favorite)
                <tr role="row">
                    <td>{{ $favorite->id }}</td>

                    <td>{{ $favorite->product->title }}</td>
                    <td>
                        {{ $favorite->user->name ?? $favorite->user->id}}
                    </td>

                    <td>{{ jdate($favorite->created_at)->format('%Y/%m/%d') }}</td>

                </tr>
                @empty
                <div>علاقه مندی وجود ندارد</div>
                @endforelse
                {{ $favorites->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
