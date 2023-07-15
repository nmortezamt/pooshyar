<div>
@section('profile','داشبورد | پروفایل - پوشیار')
<div class="tab-pane active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="card">
        <div class="card-header">
            <h3>داشبورد</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('profile.orders') }}">
                <div class="box1">
                <img src="{{ asset('pooshyar/assets/images/download.png') }}" alt="عکس" class="image1">
                <h2 class="title">سفارشات</h2>
                <p style="margin-right: 40px;">{{ \App\Models\persianNumber::translate(\App\Models\order::where('user_id',auth()->user()->id)->count()) }} سفارش</p>
              </div></a>

              <a href="{{ route('profile.payments') }}">
              <div class="box1">
                <img src="{{ asset('pooshyar/assets/images/payment.png') }}" alt="عکس" class="image1">
                <h2 class="title">پرداخت ها</h2>
                <p class="text1" style="margin-right: 40px;">{{ \App\Models\persianNumber::translate(\App\Models\payment::where('user_id',auth()->user()->id)->count()) }} پرداخت</p>
              </div>
            </a>

            <a href="{{ route('profile.favorites') }}">
              <div class="box1">
                <img src="{{ asset('pooshyar/assets/images/favorite.jpg') }}" alt="عکس" class="image1">
                <h2 class="title"> علاقه مندی ها</h2>
                <p class="text1" style="margin-right: 40px;">{{ \App\Models\persianNumber::translate(\App\Models\favorite::where('user_id',auth()->user()->id)->count())}} علاقه مندی</p>
              </div>
            </a>

        </div>
    </div>
  </div>

</div>
