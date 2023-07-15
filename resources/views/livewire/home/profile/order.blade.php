<div>
    @section('profile','سفارشات | پروفایل - پوشیار')
    <div class="tab-pane" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h3>سفارشات</h3>
        </div>
        @php
        $order = \App\Models\order::where('user_id', auth()->user()->id)
            ->where('payment', 0)
            ->orderBy('created_at', 'desc')
            ->first();

        if($order) {
            $time_passed = \Carbon\Carbon::now()->diffInMinutes($order->created_at);

        if ($time_passed > 120) {
            $order->delete();
            $message = "سفارش شما به دلیل پرداخت نشدن، لغو شده است.";
        } else {
            $time_left = 120 - $time_passed;
            $message = "توجه: در صورت عدم پرداخت تا {$time_left} دقیقه دیگر تمام یا بخشی از سفارش شما به صورت خودکار لغو خواهد شد.";
        }
    }

        @endphp

        <p class="text-danger">
            {{ $message ?? ''}}
        </p>

        @if (\App\Models\order::where('user_id',auth()->user()->id)->first())

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>سفارش</th>
                            <th>محصول</th>
                            <th>نوع خرید</th>
                            <th>قیمت</th>
                            <th>تعداد</th>
                            <th>رنگ</th>
                            <th>سایز</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>مجموع</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($orders as $order)
                        <tr wire:key="{{ $order->id }}">
                            {{-- @if ($payment->status == 0)

                            @endif --}}
                            <td>{{\App\Models\persianNumber::translate( $order->order_count )}}</td>
                            <td><a href="{{ route('product.single.index',['id'=>$order->product->id , 'link'=>$order->product->link]) }}">{{ $order->product->title }}</a></td>
                            <td>{{ $order->type == 'single' ? 'تکی' : 'عمده' }}</td>
                            <td>{{ \App\Models\persianNumber::translate(number_format($order->product_price)) }}</td>
                            <td>{{ \App\Models\persianNumber::translate($order->count) }}</td>
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

                            <td>{{ \App\Models\persianNumber::translate(jdate($order->created_at)->format('%d  %B %Y') )}}</td>
                            @if ($order->payment == 1)
                            <td class="text-success">پرداخت شده</td>
                            @else
                            <td class="text-danger">پرداخت نشده</td>
                            @endif
                            <td>{{ \App\Models\persianNumber::translate(number_format($order->price)) }}تومان برای {{ \App\Models\persianNumber::translate($order->count )}} مورد</td>

                            @if ($order->payment == 1)
                            @php
                                $paymentId = \App\Models\payment::where('order_id',$order->id)->first();
                                $invoiceId = \App\Models\invoice::where('payment_id',$paymentId->id)->first();

                            @endphp
                            <td><a href="{{ route('profile.order.invoice',$invoiceId->id) }}" class="btn btn-fill-out btn-sm" target="_blank">نمایش فاکتور</a></td>
                            @else
                            <td><a wire:click='payment({{ $order->order_count }})' class="btn btn-fill-out btn-sm text-white">ادامه پرداخت</a></td>
                            @endif

                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        @else
        <h1 class="text-center">هنوز سفارشی ندادید</h1>
        @endif

    </div>
  </div>

</div>
