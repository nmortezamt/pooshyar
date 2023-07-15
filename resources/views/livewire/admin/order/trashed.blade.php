@section('title',' سفارش های پرداخت نشده')

<div>
    <div class="main-content" wire:init='loadOrder'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('payments.index') }}">سفارشات</a>

            <a class="tab__item btn btn-danger text-white" style="margin-left:10px; float:left;"
            href="{{ route('orders.index') }}">
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
                                <th>شناسه پرداخت</th>
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
                                <th>عملیات</th>

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
                                    @foreach (\App\Models\product::where('id',$order->product_id)->get() as $product)
                                    {{ $product->title }}
                                    @endforeach
                                </td>
                                <td>{{ $order->type == 'single' ? 'تکی' : 'عمده' }}</td>

                                <td>
                                    @foreach (\App\Models\user::where('id',$order->user_id)->get() as $user)
                                    @if ($user->name)
                                    {{ $user->name .'='. $user->id}}
                                    @elseif (isset($user->id))
                                    {{ $user->id}}
                                    @else
                                    <p>'ناشناس'</p>
                                    @endif
                                    @endforeach

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
                                <td>


                                    <a wire:click='remove({{ $order->id }})' class="item-delete mlg-15"
                                        title="حذف"> </a>

                                </td>
                            </tr>

                            @empty
                            <div>پرداخت ناموفقی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $orders->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
