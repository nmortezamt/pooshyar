<div>
    <div class="container" style="margin-top: 70px" dir="rtl" id="content_invoice">
        <h1>صورت حساب</h1>
        <table id="Tableinvoice">
            <thead>
                <tr>
                    <th>سفارش</th>
                    <th>نام خریدار</th>
                    <th>اسم کالا</th>
                    <th>نوع خرید</th>
                    <th>مبلغ</th>
                    <th>تعداد</th>
                    <th>رنگ</th>
                    <th>سایز</th>
                    @if (isset($invoice->discount_code))
                        <th>کد تخفیف</th>
                    @endif
                    <th>مبلغ کل</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \App\Models\persianNumber::translate($invoice->order_number) }}</td>
                    <td>{{ $invoice->name_customer }}</td>
                    <td>{{ $invoice->name_product }}</td>
                    <td>{{ $invoice->type == 'single' ? 'تکی' : 'عمده' }}</td>
                    <td>{{ \App\Models\persianNumber::translate($invoice->price_product ?? '') }}</td>
                    <td>{{ \App\Models\persianNumber::translate($invoice->count_product) }}</td>
                    <td>
                        @php
                            $color_name = json_decode($invoice->color_product, true);
                        @endphp
                        @foreach (array_keys($color_name) as $name)
                            @if ($loop->last)
                                <span>{{ $name }}</span>
                            @else
                                <span>{{ $name }} ,</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @php
                            $size_name = json_decode($invoice->size_product, true);
                        @endphp
                        @foreach (array_keys($size_name) as $name)
                            @if ($loop->last)
                                <span>{{ $name }}</span>
                            @else
                                <span>{{ $name }} ,</span>
                            @endif
                        @endforeach
                    </td>
                    @if ($invoice->discount_code)
                        <td>
                            {{ '-' . \App\Models\persianNumber::translate($invoice->discount_price) ? \App\Models\persianNumber::translate($invoice->discount_price) . 'تومان' : \App\Models\persianNumber::translate($invoice->discount_percent) . '%' . '-' }}
                        </td>
                    @endif
                    <td>{{ \App\Models\persianNumber::translate($invoice->total_price) }}</td>
                </tr>
            </tbody>

        </table>


    </div>
    <div class="button-container">
        <button id="screenshot-btn" class="button download-button">دانلود</button>
        <button class="button print-button">چاپ</button>
    </div>
</div>
