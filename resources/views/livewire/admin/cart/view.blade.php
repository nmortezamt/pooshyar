<div>
    @section('title','جزئیات سبد خرید')
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
              <th>منطقه زمانی</th>
              <th>کد منطقه</th>
              <th>کد metro</th>
              <th>طول جغرافیایی</th>
              <th>عرض جغرافیایی</th>
              <th>کدپستی</th>
              <th>کد iso</th>
              <th>کد zip</th>
              <th>نام شهر</th>
              <th>نام منطقه</th>
              <th>کد منطقه</th>
              <th>کد کشور</th>
           </tr>

           <tr>
              <td>{{ $cart->timezone }}</td>
              <td>{{ $cart->areaCode }}</td>
              <td>{{ $cart->metroCode }}</td>
              <td>{{ $cart->longitude }}</td>
              <td>{{ $cart->latitude }}</td>
              <td>{{ $cart->postalCode}}</td>
              <td>{{ $cart->isoCode }}</td>
              <td>{{ $cart->zipCode }}</td>
              <td>{{ $cart->cityName }}</td>
              <td>{{ $cart->regionName}}</td>
              <td>{{ $cart->regionCode}}</td>
              <td>{{ $cart->countryCode}}</td>
           </tr>
        </table>
     </div>
</div>
