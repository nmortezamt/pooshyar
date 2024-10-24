<head>
    <meta charset="UTF-8">

    <title>{{$generalSetting->site_name}}
        {{request()->route('front.index') ? '-' : ''}} @yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simple-line-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl-style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">


    <script src="{{ asset('panel/js/sweetalert2@9.js') }}"></script>

    <script src="{{ asset('assets/js/jquery-search.min.js') }}"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: iransans;
            src: url('/assets/fonts/IRANSansX-Bold.woff');
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p{
            font-family: iransans;
        }
    </style>
</head>

<header class="header_wrap">
    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/{{ $generalSetting->logo }}" alt="{{ $generalSetting->site_name }}">
                    <img class="logo_dark" src="/{{ $generalSetting->logo }}" alt="logo" width="150px">
                </a>
                @include('livewire.home.home.search')

                <ul class="navbar-nav attr-nav align-items-center">
                    @auth
                        <li>
                            <a href="{{ route('profile.index') }}" class="nav-link"><i class="linearicons-user"></i></a>
                        </li>
                        @if (auth()->user()->isSuperAdmin())
                            <li><a href="{{ route('admin.index') }}" class="nav-link">ورود به پنل</a></li>
                        @endif
                    @endauth
                    @guest
                        <li>
                            <a href="{{ route('login.register.index') }}" class="nav-link"><i class="icon-login"></i>
                                ورود|ثبت نام</a>
                        </li>
                    @endguest


                    @auth
                        <li><a href="{{ route('profile.favorites') }}" class="nav-link"><i
                                    class="linearicons-heart"></i><span
                                    class="wishlist_count">{{ \Modules\Shared\Common\Helpers::convertNumbersToPersian(12)}}</span></a>
                        </li>
                    @endauth

                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger"
                                                          href="#"
                                                          data-toggle="dropdown"><i class="linearicons-bag2"></i><span
                                class="cart_count">
                                @auth
                                    {{ \Modules\Shared\Common\Helpers::convertNumbersToPersian('12') }}
                                @endauth
                            </span></a>
                        @auth
{{--                            @if (isset($carts->id))--}}
{{--                                <div class="cart_box cart_right dropdown-menu dropdown-menu-right">--}}
{{--                                    <ul class="cart_list">--}}
{{--                                        @forelse ($carts as $cart)--}}
{{--                                            <li>--}}
{{--                                                <a wire:click='removeCart({{ $cart->id }})' class="item_remove">--}}
{{--                                                    <div wire:loading wire:target="removeCart({{ $cart->id }})">--}}
{{--                                                        <i class="fas fa-spinner fa-spin"></i>--}}
{{--                                                    </div>--}}
{{--                                                    <span wire:loading.remove--}}
{{--                                                          wire:target="removeCart({{ $cart->id }})">--}}
{{--                                                    <i class="ti-close"></i>--}}
{{--                                                </span>--}}
{{--                                                </a>--}}

{{--                                                <a--}}
{{--                                                    href="{{ route('product.single.index', ['id' => $cart->product->id, 'link' => $cart->product->link]) }}"><img--}}
{{--                                                        src="/uploads/{{ $cart->product->img }}"--}}
{{--                                                        alt="{{ $cart->product->title }}">{{ $cart->product->title }}--}}
{{--                                                </a>--}}
{{--                                                <span class="cart_quantity"><span--}}
{{--                                                        class="cart_amount"></span>{{ \App\Models\persianNumber::translate(number_format($cart->product_price)) }}<span--}}
{{--                                                        class="price_symbole">x{{ \App\Models\persianNumber::translate(number_format($cart->count)) }}تومان--}}
{{--                                                </span></span>--}}
{{--                                            </li>--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
{{--                                    </ul>--}}
{{--                                    <div class="cart_footer">--}}
{{--                                        <p class="cart_total"><strong>مجموع:</strong> <span class="cart_price"> <span--}}
{{--                                                    class="price_symbole">تومان</span></span>{{ \App\Models\persianNumber::translate(number_format($carts->sum('total_price'))) }}--}}
{{--                                        </p>--}}
{{--                                        <p class="cart_buttons"><a href="{{ route('cart.index') }}"--}}
{{--                                                                   class="btn btn-fill-line view-cart">مشاهده سبد--}}
{{--                                                خرید</a>--}}
{{--                                            @if (isset($carts[0]->id) && !Request::routeIs('order.index'))--}}
{{--                                                <a wire:click='orderForm'--}}
{{--                                                   class="btn btn-fill-out checkout text-white">پرداخت</a>--}}
{{--                                            @endif--}}

{{--                                        </p>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="cart_box cart_right dropdown-menu dropdown-menu-right">--}}
{{--                                    <ul class="cart_list">--}}
{{--                                        <h5 class="title_cart_null">سبد خرید خالی می باشد</h5>--}}
{{--                                        <li>--}}
{{--                                            <img--}}
{{--                                                src="{{ asset('pooshyar/assets/images/add-to-basket-3d-illustration-png.png') }}"--}}
{{--                                                alt="سبد خرید خالی" class="img_cart_list">--}}

{{--                                        </li>--}}

{{--                                    </ul>--}}
{{--                                    <div class="cart_footer">--}}
{{--                                        <p class="cart_buttons"><a href="{{ route('cart.index') }}"--}}
{{--                                                                   class="btn btn-fill-line view-cart">مشاهده سبد--}}
{{--                                                خرید</a>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            @endif--}}
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                    <div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false"
                                class="categories_btn categories_menu">
                            <span>دسته بندی محصولات</span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse">
                            <ul>
                                @foreach (\Modules\Category\Models\Category::getProductTypeCategories()->active()->with('subcategories')->get() as $productCategory)
                                    <li class="dropdown dropdown-mega-menu">
                                        <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                           data-toggle="dropdown">
                                            {{--                                                @if (isset($slink) && $slink->parent == $category->id)--}}
                                            {{--                                                    <span class="text-danger">{{ $category->title }}</span>--}}
                                            {{--                                                @elseif(isset($link) && $link->title == $category->title)--}}
                                            {{--                                                    <span class="text-danger">{{ $category->title }}</span>--}}
                                            {{--                                                @else--}}
                                            <span>{{ $productCategory->title }}</span>
                                            {{--                                                @endif--}}
                                        </a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <li class="mega-menu-col col-lg-6">
                                                            <ul>
                                                                @foreach ($productCategory->subcategories()->active()->get() as $productSubcategory)
                                                                    <li class="dropdown-header">
                                                                        {{--                                                                            @if (isset($slink) && $slink->title == $subcategory->title)--}}
                                                                        {{--                                                                                <a href="{{ route('product.subcategory.index', $subcategory->link) }}"--}}
                                                                        {{--                                                                                   class="text-danger">{{ $subcategory->title }}</a>--}}
                                                                        {{--                                                                            @else--}}
                                                                        <a
                                                                            href="{{ route('product.subcategory.index', $productSubcategory->slug) }}">{{ $productSubcategory->title }}</a>
                                                                        {{--                                                                            @endif--}}

                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </li>
                                                        {{--                                                            @if (\App\Models\subcategory::where('parent', $category->id)->count() > 7)--}}
                                                        {{--                                                                <li class="mega-menu-col col-lg-6">--}}
                                                        {{--                                                                    <ul>--}}
                                                        {{--                                                                        @foreach (\App\Models\subcategory::where('parent', $category->id)->where('id', '!=', $subcategory->id)->take(8)->get() as $twosub)--}}
                                                        {{--                                                                            <li class="dropdown-header">--}}
                                                        {{--                                                                                @if (isset($slink) && $slink->title == $twosub->title)--}}
                                                        {{--                                                                                    <a href="{{ route('product.subcategory.index', $twosub->link) }}"--}}
                                                        {{--                                                                                       class="text-danger">{{ $twosub->title }}</a>--}}
                                                        {{--                                                                                @else--}}
                                                        {{--                                                                                    <a--}}
                                                        {{--                                                                                        href="{{ route('product.subcategory.index', $twosub->link) }}">{{ $twosub->title }}</a>--}}
                                                        {{--                                                                                @endif--}}
                                                        {{--                                                                            </li>--}}
                                                        {{--                                                                        @endforeach--}}
                                                        {{--                                                                    </ul>--}}
                                                        {{--                                                                </li>--}}
                                                        {{--                                                            @endif--}}
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-5">
                                                    <div class="header-banner2">
                                                        <img src="/{{ $productCategory->img }}"
                                                             alt="menu_banner1">
                                                        <div class="banne_info">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
{{--                                @if (\Modules\Category\Models\Category::count() > 9)--}}
{{--                                    <li>--}}
{{--                                        <ul class="more_slide_open">--}}
{{--                                            @foreach (\Modules\Category\Models\category::where('status', 1)->where('id', '>', 10)->get() as $moreCategory)--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item nav-link nav_item"--}}
{{--                                                       href="{{ route('product.category.index', $moreCategory->link) }}"><i--}}
{{--                                                            class="flaticon-fax"></i>--}}
{{--                                                        @if (isset($link) && $link->title == $moreCategory->title)--}}
{{--                                                            <span--}}
{{--                                                                class="text-danger">{{ $moreCategory->title }}</span>--}}
{{--                                                        @else--}}
{{--                                                            <span>{{ $moreCategory->title }}</span>--}}
{{--                                                        @endif--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                            </ul>--}}
{{--                            @if (\Modules\Category\Models\category::count() > 9)--}}
{{--                                <div class="more_categories">دسته بندی بیشتر</div>--}}
{{--                                @endif--}}
{{--                                </ul>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="pr_search_icon">
                            <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i
                                    class="linearicons-magnifier"></i></a>
                        </div>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li>
                                    <a class="nav-link nav_item {{ request()->routeIs('front.index') ? 'active' : '' }}"
                                       href="/">صفحه اصلی</a>
                                </li>

                                <li>
                                    <a class="nav-link nav_item {{ request()->routeIs('product.all', 'product.category.index', 'product.subcategory.index', 'product.single.index') ? 'active' : '' }}"
                                       href="{{ route('product.all') }}">محصولات</a></li>

                                <li>
                                    <a class="nav-link nav_item {{ request()->routeIs('article.all.index', 'article.single.index', 'article.category.index', 'article.subcategory.index') ? 'active' : '' }}"
                                       href="{{ route('article.all.index') }}">مقالات</a></li>
                                <li>
                                    <a class="nav-link nav_item {{ request()->routeIs('about.index') ? 'active' : '' }}"
                                       href="{{ route('about.index') }}">درباره ما</a>
                                </li>
                                <li><a class="nav-link nav_item" href="{{ route('contact.index') }}">
                                        تماس با ما</a></li>
                            </ul>
                        </div>
                        <div class="contact_phone contact_support">
                            <i class="linearicons-phone-wave"></i>
                            <a
                                href="tel:{{ $generalSetting->support_phone_number }}">
                                {{ \Modules\Shared\Common\Helpers::convertNumbersToPersian($generalSetting->support_phone_number) }}
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
