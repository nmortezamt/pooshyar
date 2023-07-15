<div>
    @section('profile','پرداختی ها | پروفایل - پوشیار')
    <div class="tab-pane" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h3>پرداختی ها</h3>
        </div>
        @php
        $payment = \App\Models\payment::where('user_id', auth()->user()->id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->first();

        if($payment) {
            $time_passed = \Carbon\Carbon::now()->diffInMinutes($payment->created_at);

        if ($time_passed > 120) {
            $payment->delete();
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
        @if (\App\Models\payment::where('user_id',auth()->user()->id)->first())

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>سفارش</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تلقن</th>
                            <th>محصول</th>
                            <th>نوع خرید</th>
                            <th>قیمت</th>
                            <th>تعداد</th>
                            <th>رنگ</th>
                            <th>سایز</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>مجموع قیمت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse (\App\Models\payment::where('user_id',auth()->user()->id)->get() as $payment)
                        <tr wire:key="{{ $payment->id }}">

                            <td>{{\App\Models\persianNumber::translate( $payment->order_number )}}</td>
                            <td>{{ $payment->name . ' '. $payment->lname }}</td>
                            <td>{{ \App\Models\persianNumber::translate($payment->phone) }}</td>
                            <td><a href="{{ route('product.single.index',['id'=>$payment->product->id , 'link'=>$payment->product->link]) }}">{{ $payment->product->title }}</a></td>
                            <td>{{ $payment->type == 'single' ? 'تکی' : 'عمده' }}</td>
                            <td>{{ \App\Models\persianNumber::translate(number_format($payment->product_price)) }}</td>
                            <td>{{ \App\Models\persianNumber::translate(number_format($payment->count)) }}</td>

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

                            <td>{{ \App\Models\persianNumber::translate(jdate($payment->created_at)->format('%d  %B %Y') )}}</td>
                            @if ($payment->status == 1)
                            <td class="text-success">پرداخت شده</td>
                            @else
                            <td class="text-danger">پرداخت نشده</td>
                            @endif
                            <td>{{ \App\Models\persianNumber::translate(number_format($payment->total_price)) }}تومان برای {{ \App\Models\persianNumber::translate($payment->count )}} مورد</td>

                            @if ($payment->status == 1)
                            @php
                                $invoiceId = \App\Models\invoice::where('payment_id',$payment->id)->first();
                            @endphp
                            <td>
                                <a href="{{ route('profile.order.invoice',$invoiceId->id) }}" class="btn btn-fill-out btn-sm" target="_blank">نمایش فاکتور</a>
                            </td>
                            @else
                            <td>

                                <a wire:click='payment({{ $payment->id }})' class="btn btn-fill-out btn-sm text-white">پرداخت</a>
                                <div wire:loading wire:target="payment({{ $payment->id }})">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </td>
                            @endif

                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        @else
        <h1 class="text-center">هنوز پرداختی انجام نداید!</h1>
        @endif

    </div>
  </div>

</div>
