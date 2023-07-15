<div>
    <div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href=""></a>
    <div class="profile__info border cursor-poiter text-center">
        <div class="avatar__img">
            @if (auth()->user()->img)
            <img src="/uploads/{{ auth()->user()->img }}" class="avatar___img">
                @else
                <img src="{{ asset('panel/img/pro.jpg') }}" class="avatar___img">
            @endif

            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">
            {{ auth()->user()->admin ? 'ادمین :' : 'کارمند :' }}

            {{ auth()->user()->name }}</span>    </div>

    <ul>
        @can('show-admin')

        <li class="item-li i-dashboard {{ Request::routeIs('admin.index') ? 'is-active' : ''}} "><a href="{{ route('admin.index') }}">پیشخوان</a></li>
        @endcan

        @can('show-category')

        <li class="item-li i-categories {{ Request::routeIs('category.index') ? 'is-active' : ''}}"><a href="{{ route('category.index') }}">دسته بندی محصولات</a></li>
        @endcan

        @can('show-category-article')
        <li class="item-li i-categories {{ Request::routeIs('category.article.index') ? 'is-active' : ''}}"><a href="{{ route('category.article.index') }}">دسته بندی مقالات</a></li>
        @endcan

        @can('show-article')
        <li class="item-li i-articles {{ Request::routeIs('article.index') ? 'is-active' : ''}}"><a href="{{ route('article.index') }}">مقالات</a></li>
        @endcan
        <hr>
        @can('show-product')
        <li class="item-li i-courses {{ Request::routeIs('product.index') ? 'is-active' : ''}}"><a href="{{ route('product.index') }}">محصولات</a></li>
        @endcan

        @can('show-brand')
        <li class="item-li i-my__purchases {{ Request::routeIs('brand.index') ? 'is-active' : ''}}"><a href="{{ route('brand.index') }}">برندها</a></li>
        @endcan

        @can('show-color')
        <li class="item-li i-my__purchases {{ Request::routeIs('color.index') ? 'is-active' : ''}}"><a href="{{ route('color.index') }}">رنگ محصول</a></li>
        @endcan

        @can('show-size')
        <li class="item-li i-my__purchases {{ Request::routeIs('size.index') ? 'is-active' : ''}}"><a href="{{ route('size.index') }}">سایز محصول</a></li>
        @endcan

        @can('show-gallery')
        <li class="item-li i-my__purchases {{ Request::routeIs('gallery.index') ? 'is-active' : ''}}"><a href="{{ route('gallery.index') }}">گالری تصاویر محصولات</a></li>
        @endcan

        @can('show-attribute')
        <li class="item-li i-transactions {{ Request::routeIs('attribute.index') ? 'is-active' : ''}}"><a href="{{ route('attribute.index') }}">مشخصات محصول</a></li>
        @endcan

        <hr>

        @can('show-page')
        <li class="item-li i-slideshow {{ Request::routeIs('page.index') ? 'is-active' : ''}}"><a href="{{ route('page.index') }}"> صفحات</a></li>
        @endcan

        @can('show-newsletter')
        <li class="item-li i-notification__management {{ Request::routeIs('newsletter.index') ? 'is-active' : ''}}"><a href="{{ route('newsletter.index') }}"> خبرنامه</a></li>
        @endcan

        @can('show-social')
        <li class="item-li i-ads {{ Request::routeIs('social.index') ? 'is-active' : ''}}"><a href="{{ route('social.index') }}">شبکه اجتماعی</a></li>
        @endcan

        @can('show-footer')
        <li class="item-li i-slideshow {{ Request::routeIs('one.index') ? 'is-active' : ''}}"><a href="{{ route('one.index') }}"> تنظیمات فوتر سایت</a></li>
        @endcan

        @can('show-header')
        <li class="item-li i-banners
        {{ Request::routeIs('header.index') ? 'is-active' : ''}}"><a href="{{ route('header.index') }}"> تنظیمات هدر سایت</a></li>
        @endcan

        @can('show-log')
        <li class="item-li i-user__inforamtion {{ Request::routeIs('log.index') ? 'is-active' : ''}}"><a href="{{ route('log.index') }}"> گزارشات سیستم</a></li>
        @endcan

        <hr>
        @can('show-permission')
        <li class="item-li i-user__inforamtion {{ Request::routeIs('permission.index') ? 'is-active' : ''}}"><a href="{{ route('permission.index') }}"> دسترسی ها</a></li>
        @endcan

        @can('show-users')
        <li class="item-li i-users {{ Request::routeIs('users.index') ? 'is-active' : ''}}"><a href="{{ route('users.index') }}"> کاربران</a></li>
        @endcan

        @can('show-sms')
        <li class="item-li i-tickets {{ Request::routeIs('sms.index') ? 'is-active' : ''}}"><a href="{{ route('sms.index') }}"> پیامک ها</a></li>
        @endcan

        @can('show-search-history')
        <li class="item-li i-user__inforamtion {{ Request::routeIs('search.history.index') ? 'is-active' : ''}}"><a href="{{ route('search.history.index') }}">تاریخچه جستجوها</a></li>
        @endcan

        <hr>
        @can('show-comment-article')
        <li class="item-li i-comments {{ Request::routeIs('comment.article.index') ? 'is-active' : ''}}"><a href="{{ route('comment.article.index') }}"> کامنت ها</a></li>
        @endcan

        @can('show-favorite')
        <li class="item-li i-discounts {{ Request::routeIs('list.favorite.index') ? 'is-active' : ''}}"><a href="{{ route('list.favorite.index') }}"> علاقه مندی ها</a></li>
        @endcan

        @can('show-carts')
        <li class="item-li i-discounts {{ Request::routeIs('carts.admin') ? 'is-active' : ''}}"><a href="{{ route('carts.admin') }}">سبد خرید</a></li>
        @endcan

        @can('show-orders')
        <li class="item-li i-user__inforamtion {{ Request::routeIs('orders.index') ? 'is-active' : ''}}"><a href="{{ route('orders.index') }}"> سفارشات</a></li>
        @endcan

        @can('show-payment')
        <li class="item-li i-my__purchases {{ Request::routeIs('payments.index') ? 'is-active' : ''}}"><a href="{{ route('payments.index') }}"> پرداخت ها</a></li>
        @endcan

        @can('show-invoices')
        <li class="item-li i-transactions {{ Request::routeIs('invoices.index') ? 'is-active' : ''}}"><a href="{{ route('invoices.index') }}"> صورتحساب</a></li>
        @endcan

        @can('show-discount-code')
        <li class="item-li i-discounts {{ Request::routeIs('discount.code.index') ? 'is-active' : ''}}"><a href="{{ route('discount.code.index') }}"> کد تخفیف ها</a></li>
        @endcan

        <hr>

        @can('show-end-season-discount')
        <li class="item-li i-banners {{ Request::routeIs('end.season.discount') ? 'is-active' : ''}}"><a href="{{ route('end.season.discount') }}"> بنرهای تخفیفات</a></li>
        @endcan




{{--
        <li class="item-li i-slideshow"><a href="slideshow.html">اسلایدشو</a></li>
        <li class="item-li i-banners"><a href="banners.html">بنر ها</a></li>
        <li class="item-li i-ads"><a href="ads.html">تبلیغات</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>
        <li class="item-li i-tickets"><a href="tickets.html"> تیکت ها</a></li>
        <li class="item-li i-discounts"><a href="discounts.html">تخفیف ها</a></li>
        <li class="item-li i-transactions"><a href="transactions.html">تراکنش ها</a></li>
        <li class="item-li i-checkouts"><a href="checkouts.html">تسویه حساب ها</a></li>
        <li class="item-li i-checkout__request "><a href="checkout-request.html">درخواست تسویه </a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید های من</a></li>
        <li class="item-li i-notification__management"><a href="notification-management.html">مدیریت اطلاع رسانی</a>
        </li>
        <li class="item-li i-user__inforamtion"><a href="user-information.html">اطلاعات کاربری</a></li> --}}
    </ul>

</div>
</div>
