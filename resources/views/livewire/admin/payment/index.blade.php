<div>
        @section('title',' پرداخت ها')
    <div>
        <div class="main-content" wire:init='loadPayment'>
            <div class="tab__box">
                <div class="tab__items">

                    <a class="tab__item" href="{{ route('orders.index') }}">سفارشات</a>
                    <a class="tab__item" href="{{ route('carts.admin') }}">سبد خریدها</a>
                    <a class="tab__item is-active" href="{{ route('payments.index') }}">پرداخت ها</a>
                    <a class="tab__item" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
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
                <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
                href="{{ route('payments.failed') }}"
                >پرداخت نشده ها
                ({{ \App\Models\payment::onlyTrashed()->count() }})
                </a>

            </div>

            <div class="table__box">
                <table class="table table-bordered">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>آیدی</th>
                        <th>کد سفارش</th>
                        <th>آیدی سفارش</th>
                        <th>شناسه پرداخت</th>
                        <th>درگاه پرداخت</th>
                        <th>پرداخت</th>
                        <th>محصول</th>
                        <th>نوع خرید</th>
                        <th>کاربر</th>
                        <th>آپی</th>
                        <th>تعداد</th>
                        <th>رنگ</th>
                        <th>سایز</th>
                        <th>کد تخفیف</th>
                        <th>قیمت کد تخفیف</th>
                        <th>درصد کد تخفیف</th>
                        <th>مجموع قیمت</th>
                        <th>تاریخ ایجاد پرداخت</th>
                        <th>عملیت</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if ($readyToLoad)
                    @forelse ($payments as $payment)
                    <tr role="row">
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->order_number }}</td>
                        <td>{{ $payment->order_id }}</td>
                        <td>{{ $payment->transactionId ?? 'ندارد'}}</td>
                        <td>{{ $payment->driver ?? 'ندارد'}}</td>

                        <td>
                            @if ($payment->status == 1)
                            <div class="alert-sm alert-success">پرداخت شده</div>
                            @else
                            <div class="alert-sm alert-danger">پرداخت نشده</div>
                            @endif
                        </td>
                        <td>{{ $payment->product->title }}</td>
                        <td>{{ $payment->type == 'single' ? 'تکی' : 'عمده' }}</td>

                        <td>
                            {{ $payment->user->name ? $payment->user->name .'='. $payment->user->id : $payment->user->id}}
                        </td>
                        <td>{{ $payment->ip }}</td>
                        <td>{{ $payment->count}}</td>
                        <td>
                        @php
                            $color_name = json_decode($payment->color_id,true);
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
                            $size_name = json_decode($payment->size_id,true);
                            @endphp
                            @foreach(array_keys($size_name) as $name)
                            @if($loop->last)
                            <span>{{ $name }}</span>
                            @else
                            <span>{{ $name }} ,</span>
                            @endif
                            @endforeach
                        </td>
                        <td>{{ $payment->discount_code ?? 'ندارد'}}</td>
                        <td>{{ $payment->discount_price ? number_format($payment->discount_price): 'ندارد'}}</td>
                        <td>{{ $payment->discount_percent ? $payment->discount_percent.'%' : 'ندارد'}}</td>
                        <td>{{ number_format($payment->total_price)}}</td>
                        <td>{{ jdate($payment->created_at)->format('%Y/%m/%d') }}</td>
                        <td>
                            <a href="{{ route('payments.view',$payment) }}" class="item-eye"
                            title="نمایش"> </a>
                        </td>
                    </tr>
                    @empty
                    <div>سفارشی وجود ندارد</div>
                    @endforelse
                    {{ $payments->render() }}
                    @else
                    <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
