<div>
    @section('title',' سفارشات')
<div>
    <div class="main-content" wire:init='loadOrder'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item is-active" href="{{ route('orders.index') }}">سفارشات</a>
                <a class="tab__item" href="{{ route('carts.admin') }}">سبد خریدها</a>
                <a class="tab__item" href="{{ route('payments.index') }}">پرداخت ها</a>
                <a class="tab__item" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
                <a class="tab__item" href="{{ route('list.favorite.index') }}">علاقه مندی ها</a>
                <a class="tab__item" href="{{ route('invoices.index') }}">صورتحساب</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی سفارش ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('orders.failed') }}"
            >سفارشات پرداخت نشده
            ({{ \App\Models\order::onlyTrashed()->count() }})
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>کد سفارش</th>
                    <th>شناسه پرداخت</th>
                    <th>پرداخت</th>
                    <th>محصول</th>
                    <th>نوع خرید</th>
                    <th>کاربر</th>
                    <th>آپی</th>
                    <th>تعداد</th>
                    <th>قیمت محصول</th>
                    <th>رنگ</th>
                    <th>سایز</th>
                    <th>کد تخفیف</th>
                    <th>قیمت کد تخفیف</th>
                    <th>درصد کد تخفیف</th>
                    <th>مجموع قیمت</th>
                    <th>تاریخ ایجاد سفارش</th>


                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($orders as $order)
                <tr role="row">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_count }}</td>
                    <td>{{ $order->transactionId ?? 'ندارد'}}</td>
                    <td>
                        @if ($order->payment == 1)
                        <div class="alert-sm alert-success">پرداخت شده</div>
                        @else
                        <div class="alert-sm alert-danger">پرداخت نشده</div>
                        @endif
                    </td>
                    <td>{{ $order->product->title }}</td>
                    <td>{{ $order->type == 'single' ? 'تکی' : 'عمده' }}</td>
                    <td>
                        @if (isset($order->user->name))
                        {{ $order->user->name .'='.$order->user->id}}
                        @elseif (isset($order->user->id))
                        {{ $order->user->id}}
                        @else
                        'ناشناس'
                        @endif
                    </td>
                    <td>{{ $order->ip }}</td>
                    <td>{{ $order->count}}</td>
                    <td>{{ $order->product_price}}</td>
                    <td>
                        @php
                            $color_name = json_decode($order->color_id,true);
                        @endphp
                            @foreach(array_keys($color_name) as $name)
                                @if($loop->last)
                                    <span>{{ $name }}</span>
                                @else
                                    <span>{{ $name }} ,</span>
                                @endif
                            @endforeach
                    </td>
                    <td>
                        @php
                            $size_name = json_decode($order->size_id,true);
                            @endphp
                            @foreach(array_keys($size_name) as $name)
                            @if($loop->last)
                            <span>{{ $name }}</span>
                            @else
                            <span>{{ $name }} ,</span>
                            @endif
                            @endforeach
                    </td>
                    <td>{{ $order->discount_code ?? 'ندارد'}}</td>
                    <td>{{ $order->discount_price ?? 'ندارد'}}</td>
                    <td>{{ $order->discount_percent ?? 'ندارد'}}</td>
                    <td>{{ $order->price}}</td>
                    <td>{{ jdate($order->created_at)->format('%Y/%m/%d') }}</td>
                </tr>
                @empty
                <div>سفارشی وجود ندارد</div>
                @endforelse
                {{ $orders->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
