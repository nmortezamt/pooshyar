@section('chart-payment')
    <div id="chart-container"></div>
    <script>
        let datas = @json($datas);
        Highcharts.chart('chart-container', {
            title: {
                text: 'خرید جدید'
            },
            subtitle: {
                text: 'test'
            },
            xAxis: {
                categories: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی',
                    'بهمن', 'اسفند'
                ]
            },
            yAxis: {
                title: {
                    text: 'number of payment'
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
                name: 'new payment',
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
@endsection
