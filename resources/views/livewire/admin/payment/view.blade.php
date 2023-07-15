<div>
    @section('title','جزئیات پرداخت')
    <style>
    @font-face{
        font-family: 'iran';
        src: url({{ asset('pooshyar/assets/fonts/IRANSansX-Bold.woff') }});
    }
        #table {
   border-collapse: collapse;
   font-family: Arial;
   font-size: 14px;
   text-align: center;
   width: 100%;
   font-family: 'iran';
}

#table th {
   background-color: #333;
   color: #ffffff;
   font-weight: bold;
   padding: 10px;
   text-transform: uppercase;
}

#table td {
   background-color: #f2f2f2;
   color: #333;
   padding: 10px;
}

#table tr:nth-child(even) td {
   background-color: #e6e6e6;
}
    </style>
    <div class="container">
        <table id="table">
           <tr>
              <th>نام سفارش دهنده</th>
              <th>نام خانوادگی سفارش دهنده</th>
              <th>استان سفارش دهنده</th>
              <th>شهر سفارش دهنده</th>
              <th>آدرس سفارش دهنده</th>
              <th>آدرس 2 سفارش دهنده</th>
              <th>کدپستی سفارش دهنده</th>
              <th>شماره تلفن سفارش دهنده</th>
              <th>ایمیل سفارش دهنده</th>
              <th>اطلاعات بیشتر سفارش دهنده</th>
           </tr>

           <tr>
              <td>{{ $payment->name }}</td>
              <td>{{ $payment->lname }}</td>
              <td>{{ $payment->state }}</td>
              <td>{{ $payment->city }}</td>
              <td>{{ $payment->address }}</td>
              <td>{{ $payment->address_two ?? 'ندارد'}}</td>
              <td>{{ substr($payment->postal_code, 0, 5) . '-' . substr($payment->postal_code, 5, 5) }}</td>
              <td>{{ $payment->phone }}</td>
              <td>{{ $payment->email }}</td>
              <td>{{ $payment->info ?? 'ندارد'}}</td>
           </tr>
        </table>
     </div>
</div>
