@section('title', 'داشبورد')
<div>

    <div class="main-content">
        <div class="row no-gutters font-size-13 margin-bottom-10">

            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> کل فروش ها</p>
                <p>{{ number_format(\App\Models\payment::where('status', 1)->sum('total_price')) }} تومان</p>
            </div>

            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد دیروز </p>
                <p>{{ number_format($yesterdayPayment) }} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد امروز </p>
                <p>{{ number_format($todayPayment) }} تومان</p>
            </div>

        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">

            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد یک ماه گذاشته</p>
                <p>{{ number_format($datePayment_30) }} تومان</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-12 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                نمودار پرداخت های پوشیار
                <div>
                    <div id="chart-container"></div>
                    <script>
                        let datas = @json($datas);
                        Highcharts.chart('chart-container', {
                            title: {
                                text: 'پرداخت های موفق'
                            },
                            subtitle: {
                                text: '1402'
                            },
                            xAxis: {
                                categories: @json($monthNames)
                            },
                            yAxis: {
                                title: {
                                    text: 'تعداد پرداختی ها'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'خرید موفق 🤑',
                                data: datas
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        })
                    </script>
                </div>
                <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

                </div>
            </div>
            <div class="row bg-white no-gutters font-size-13">
                <div class="title__row">
                    <p>تراکنش های اخیر شما</p>
                    <a href="{{ route('payments.index') }}" class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
                </div>
                <div class="table__box">
                    <table width="100%" class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه پرداخت</th>
                                <th>شناسه سفارش</th>
                                <th>شماره پرداخت کننده</th>
                                <th>مبلغ (تومان)</th>
                                <th>تاریخ و ساعت</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr role="row">
                                    <td><a>{{ $transaction->id }}</a></td>
                                    <td><a>{{ $transaction->order_number }}</a></td>
                                    <td><a>{{ $transaction->user->number }}</a></td>
                                    <td><a>{{ number_format($transaction->total_price) }}</a></td>
                                    <td><a>{{ jdate($transaction->created_at)->format('%B %d , %Y') }}</a></td>
                                    @if ($transaction->status == 1)
                                        <td><a class="text-success">پرداخت موفق</a></td>
                                    @else
                                        <td><a class="text-error">پرداخت ناموفق</a></td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
