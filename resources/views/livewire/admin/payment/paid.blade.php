<div>
    @section('title',' پرداخت نهایی')
<div>
    <div class="main-content" wire:init='loadBankPayment'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('orders.index') }}">سفارشات</a>
                <a class="tab__item" href="{{ route('carts.admin') }}">سبد خریدها</a>
                <a class="tab__item" href="{{ route('payments.index') }}">پرداخت ها</a>
                <a class="tab__item is-active" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
                <a class="tab__item" href="{{ route('list.favorite.index') }}">علاقه مندی ها</a>
                <a class="tab__item" href="{{ route('invoices.index') }}">صورتحساب</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی پرداخت ">
            </div>
            </form>
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>کد سفارش</th>
                    <th>آیدی پرداخت</th>
                    <th>پرداخت</th>
                    <th>کاربر</th>
                    <th>آپی</th>
                    <th>مجموع قیمت</th>
                    <th>تاریخ ایجاد پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($bankPaid as $paid)
                <tr role="row">
                    <td>{{ $paid->id }}</td>
                    <td>{{ $paid->order_number }}</td>
                    <td>{{ $paid->payment_id }}</td>
                    <td>
                        @if ($paid->status == 1)
                        <div class="alert-sm alert-success">پرداخت شده</div>
                        @else
                        <div class="alert-sm alert-danger">پرداخت نشده</div>
                        @endif
                    </td>

                    <td>
                        {{ $paid->user->name ?? $paid->user->id}}
                    </td>
                    <td>{{ $paid->ip }}</td>
                    <td>{{ number_format($paid->price)}}</td>
                    <td>{{ jdate($paid->created_at)->format('%Y/%m/%d') }}</td>
                </tr>
                @empty
                <div>پرداختی وجود ندارد</div>
                @endforelse
                {{ $bankPaid->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
