<div>
    @section('title',' صورتحساب')
<div>
    <div class="main-content" wire:init='loadInvoice'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('orders.index') }}">سفارشات</a>
                <a class="tab__item" href="{{ route('carts.admin') }}">سبد خریدها</a>
                <a class="tab__item" href="{{ route('payments.index') }}">پرداخت ها</a>
                <a class="tab__item" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
                <a class="tab__item" href="{{ route('list.favorite.index') }}">علاقه مندی ها</a>
                <a class="tab__item is-active" href="{{ route('invoices.index') }}">صورتحساب</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی صورتحساب ">
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
                    <th>شناسه پرداخت</th>
                    <th>نام مشتری</th>
                    <th>نام خانوادگی مشتری</th>
                    <th>شماره تلفن مشتری</th>
                    <th>ایمیل مشتری</th>
                    <th>آیدی کاربر</th>
                    <th>محصول</th>
                    <th>نوع خرید</th>
                    <th>قیمت محصول</th>
                    <th>تعداد</th>
                    <th>رنگ</th>
                    <th>سایز</th>
                    <th>کد تخفیف</th>
                    <th>قیمت کد تخفیف</th>
                    <th>درصد کد تخفیف</th>
                    <th>مجموع قیمت</th>
                    <th>تاریخ ایجاد پرداخت</th>

                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($invoices as $invoice)
                <tr role="row">
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->order_number }}</td>
                    <td>{{ $invoice->payment_id }}</td>
                    <td>{{ $invoice->transactionId}}</td>
                    <td>{{ $invoice->name_customer}}</td>
                    <td>{{ $invoice->family_customer}}</td>
                    <td>{{ $invoice->phone_customer}}</td>
                    <td>{{ $invoice->email_customer}}</td>
                    <td>{{ $invoice->user_id_customer}}</td>
                    <td>{{ $invoice->name_product}}</td>
                    <td>{{ $invoice->type == 'single' ? 'تکی' : 'عمده' }}</td>
                    <td>{{ $invoice->price_product}}</td>
                    <td>{{ $invoice->count}}</td>
                    <td>
                    @php
                        $color_name = json_decode($invoice->color_product,true);
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
                        $size_name = json_decode($invoice->size_product,true);
                        @endphp
                        @foreach(array_keys($size_name) as $name)
                        @if($loop->last)
                        <span>{{ $name }}</span>
                        @else
                        <span>{{ $name }} ,</span>
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $invoice->discount_code ?? 'ندارد'}}</td>
                    <td>{{ $invoice->discount_price ? number_format($invoice->discount_price) : 'ندارد'}}</td>
                    <td>{{ $invoice->discount_percent ? $invoice->discount_percent .'%' : 'ندارد'}}</td>
                    <td>{{ number_format($invoice->total_price)}}</td>
                    <td>{{ jdate($invoice->created_at)->format('%Y/%m/%d') }}</td>
                </tr>
                @empty
                <div>صورتحسابی وجود ندارد</div>
                @endforelse
                {{ $invoices->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
