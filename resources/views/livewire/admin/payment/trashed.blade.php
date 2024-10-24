@section('title',' پرداخت های ناموفق')

<div>
    <div class="main-content" wire:init='loadPayment'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('payments.index') }}">پرداختی ها</a>

                <a class="tab__item btn btn-danger text-white" style="margin-left:10px; float:left;"
                   href="{{ route('payments.index') }}">
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
                                <th>کد سفارش</th>
                                <th>آیدی سفارش</th>
                                <th>شناسه پرداخت</th>
                                <th>نام مشتری</th>
                                <th>فامیلی مشتری</th>
                                <th>شماره تلفن مشتری</th>
                                <th>ایمیل مشتری</th>
                                <th>ستان مشتری</th>
                                <th>شهر مشتری</th>
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
                                        <td>{{ $payment->name}}</td>
                                        <td>{{ $payment->lname}}</td>
                                        <td>{{ $payment->phone}}</td>
                                        <td>{{ $payment->email}}</td>
                                        <td>{{ $payment->state}}</td>
                                        <td>{{ $payment->city}}</td>
                                        <td>
                                            @foreach (\Modules\Product\Product\Models\product::where('id',$payment->product_id)->get() as $product)
                                                {{ $product->title }}
                                            @endforeach
                                        </td>
                                        <td>{{ $payment->type == 'single' ? 'تکی' : 'عمده' }}</td>

                                        <td>
                                            @foreach (\Modules\User\Models\user::where('id',$payment->user_id)->get() as $user)
                                                {{ $user->name .'='. $user->id  ?? $user->id}}
                                            @endforeach
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
                                        <td>{{ number_format($payment->discount_price) ?? 'ندارد'}}</td>
                                        <td>{{ $payment->discount_percent.'%' ?? 'ندارد'}}</td>
                                        <td>{{ number_format($payment->total_price)}}</td>
                                        <td>{{ jdate($payment->created_at)->format('%Y/%m/%d') }}</td>
                                        <td>


                                            <a wire:click='remove({{ $payment->id }})' class="item-delete mlg-15"
                                               title="حذف"> </a>

                                        </td>
                                    </tr>

                                @empty
                                    <div>پرداخت ناموفقی وجود ندارد</div>
                                @endforelse

                            </tbody>
                            {{ $payments->render() }}
                            @else
                                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
