<div class="col-lg-3 col-md-4">
    <div class="dashboard_menu">
        <ul class="nav nav-tabs flex-column" role="tablist">
          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}"><i class="ti-layout-grid2"></i>داشبورد</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.orders') ? 'active' : '' }}" href="{{ route('profile.orders') }}"><i class="ti-shopping-cart-full"></i>سفارشات</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.payments') ? 'active' : '' }}" href="{{ route('profile.payments') }}"><i style="font-size:14px" class="fa">&#xf09d;</i>پرداختی ها</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.favorites') ? 'active' : '' }}" href="{{ route('profile.favorites') }}"><i class="linearicons-heart"></i>علاقه مندی ها</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.comments') ? 'active' : '' }}" href="{{ route('profile.comments') }}"><i class="far fa-comment-dots"></i>دیدگاه ها</a>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link" href="#address" role="tab"><i class="ti-location-pin"></i>My Address</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('profile.details') ? 'active' : '' }}" href="{{ route('profile.details') }}"><i class="ti-id-badge"></i>جزئیات حساب</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout.index') }}"><i class="ti-lock"></i>خروج از حساب کاربری</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}"><i class="fas fa-home"></i>برگشت به صفحه اصلی</a>
          </li>
        </ul>
    </div>
</div>
