<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="fa">
    <!-- SITE TITLE -->
    <title>پوشیار - صفحه پیدا نشد</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('pooshyar/assets/images/favicon.png') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/animate.css') }}">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> --}}
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/simple-line-icons.css') }}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/magnific-popup.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/slick-theme.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/responsive.css') }}">
    <!-- RTL CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/rtl-style.css') }}">

    <!-- jquery-ui CSS -->
    <link rel="stylesheet" href="{{ asset('pooshyar/assets/css/jquery-ui.css') }}">


    <script src="{{ asset('panel/js/sweetalert2@9.js') }}"></script>

    <script src="{{ asset('pooshyar/assets/js/jquery-search.min.js') }}"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: iransans;
            src: url('/pooshyar/assets/fonts/IRANSansX-Bold.woff');
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: iransans;
        }
    </style>

</head>

<body>
@php
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[0])) {
        $menu1 = \App\Models\SiteHeader::where('status', 1)->get()[0];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[1])) {
        $menu2 = \App\Models\SiteHeader::where('status', 1)->get()[1];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[2])) {
        $menu3 = \App\Models\SiteHeader::where('status', 1)->get()[2];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[3])) {
        $menu4 = \App\Models\SiteHeader::where('status', 1)->get()[3];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[4])) {
        $menu5 = \App\Models\SiteHeader::where('status', 1)->get()[4];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[5])) {
        $menu6 = \App\Models\SiteHeader::where('status', 1)->get()[5];
    }
    if (isset(\App\Models\SiteHeader::where('status', 1)->get()[6])) {
        $menu7 = \App\Models\SiteHeader::where('status', 1)->get()[6];
    }
    $tel = \App\Models\footerTitle::get()[2];
    $logo = \App\Models\logoSite::get()[0];

@endphp
        <!-- START HEADER -->
<header class="header_wrap">
    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/uploads/{{ $logo->img }}" alt="{{ env('APP_NAME') }}">
                    <img class="logo_dark" src="/uploads/{{ $logo->img }}" alt="logo" width="150px">
                </a>
                @include('livewire.home.home.search')

                <ul class="navbar-nav attr-nav align-items-center">

                </ul>
            </div>
        </div>
    </div>

    <div class="bottom_header dark_skin main_menu_uppercase border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                    <div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent"
                                aria-expanded="false" class="categories_btn categories_menu">
                            <span>{{ $menu4->title ?? '' }}</span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse">
                            <ul>
                                @foreach (\Modules\Category\Models\category::where('status', 1)->take(10)->get() as $category)
                                    @if (\App\Models\subcategory::where('parent', $category->id)->first() != null)
                                        <li class="dropdown dropdown-mega-menu">
                                            <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                               data-toggle="dropdown">
                                                @if (isset($slink) && $slink->parent == $category->id)
                                                    <span class="text-danger">{{ $category->title }}</span>
                                                @elseif(isset($link) && $link->title == $category->title)
                                                    <span class="text-danger">{{ $category->title }}</span>
                                                @else
                                                    <span>{{ $category->title }}</span>
                                                @endif
                                            </a>
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu d-lg-flex">
                                                    <li class="mega-menu-col col-lg-7">
                                                        <ul class="d-lg-flex">
                                                            <li class="mega-menu-col col-lg-6">
                                                                <ul>
                                                                    @foreach (\App\Models\subcategory::where('parent', $category->id)->take(8)->get() as $subcategory)
                                                                        <li class="dropdown-header">
                                                                            @if (isset($slink) && $slink->title == $subcategory->title)
                                                                                <a href="{{ route('product.subcategory.index', $subcategory->link) }}"
                                                                                   class="text-danger">{{ $subcategory->title }}</a>
                                                                            @else
                                                                                <a
                                                                                        href="{{ route('product.subcategory.index', $subcategory->link) }}">{{ $subcategory->title }}</a>
                                                                            @endif

                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </li>
                                                            @if (\App\Models\subcategory::where('parent', $category->id)->count() > 7)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul>
                                                                        @foreach (\App\Models\subcategory::where('parent', $category->id)->where('id', '!=', $subcategory->id)->take(8)->get() as $twosub)
                                                                            <li class="dropdown-header">
                                                                                @if (isset($slink) && $slink->title == $twosub->title)
                                                                                    <a href="{{ route('product.subcategory.index', $twosub->link) }}"
                                                                                       class="text-danger">{{ $twosub->title }}</a>
                                                                                @else
                                                                                    <a
                                                                                            href="{{ route('product.subcategory.index', $twosub->link) }}">{{ $twosub->title }}</a>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-5">
                                                        <div class="header-banner2">
                                                            <img src="/uploads/{{ $category->img }}"
                                                                 alt="menu_banner1">
                                                            <div class="banne_info">
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                    @endif

                                @endforeach
                                @if (\Modules\Category\Models\category::count() > 9)
                                    <li>
                                        <ul class="more_slide_open">
                                            @foreach (\Modules\Category\Models\category::where('status', 1)->where('id', '>', 10)->get() as $moreCategory)
                                                <li>
                                                    <a class="dropdown-item nav-link nav_item"
                                                       href="{{ route('product.category.index', $moreCategory->link) }}"><i
                                                                class="flaticon-fax"></i>
                                                        @if (isset($link) && $link->title == $moreCategory->title)
                                                            <span
                                                                    class="text-danger">{{ $moreCategory->title }}</span>
                                                        @else
                                                            <span>{{ $moreCategory->title }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                            @if (\Modules\Category\Models\category::count() > 9)
                                <div class="more_categories">دسته بندی بیشتر</div>
                                @endif
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9" wire:ignore>
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
                                    <a class="nav-link nav_item {{ Request::routeIs('home.index') ? 'active' : '' }}"
                                       href="{{ $menu1->link ?? '' }}">{{ $menu1->title ?? '' }}</a>
                                </li>

                                <li>
                                    <a class="nav-link nav_item {{ Request::routeIs('product.all', 'product.category.index', 'product.subcategory.index', 'product.single.index') ? 'active' : '' }}"
                                       href=" {{ route('product.all') }}">{{ $menu2->title ?? '' }}</a></li>

                                <li>
                                    <a class="nav-link nav_item {{ Request::routeIs('article.all.index', 'article.single.index', 'article.category.index', 'article.subcategory.index') ? 'active' : '' }}"
                                       href="{{ route('article.all.index') }}">{{ $menu3->title ?? '' }}</a>
                                </li>
                                </li>
                                <li>
                                    <a class="nav-link nav_item {{ Request::routeIs('about.index') ? 'active' : '' }}"
                                       href="{{ route('about.index') }}">{{ $menu5->title ?? '' }}</a>
                                </li>
                                <li>
                                    <a class="nav-link nav_item"
                                       href="{{ $menu6->link ?? '' }}">{{ $menu6->title ?? '' }}</a>
                                </li>
                                <li><a class="nav-link nav_item" href="{{ route('contact.index') }}">
                                        {{ $menu7->title ?? '' }}</a></li>
                            </ul>
                        </div>
                        <div class="contact_phone contact_support">
                            <i class="linearicons-phone-wave"></i>
                            <a
                                    href="tel:{{ $tel->title }}">{{ \App\Models\persianNumber::translate($tel->title) }}</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
<div class="section">
    <div class="error_wrap">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-10 order-lg-first">
                    <div class="text-center">
                        <div class="error_txt">404</div>
                        <h5 class="mb-2 mb-sm-3"> صفحه مورد نظر شما یافت نشد!
                        </h5>
                        <p>صفحه ای که به دنبال آن هستید منتقل شده، حذف شده، نام آن تغییر کرده یا ممکن است اصلاً وجود
                            نداشته باشد.
                        </p>
                        <a href="{{ route('home.index') }}" class="btn btn-fill-out">برگشت به صفحه اصلی</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('livewire.home.home.footer')

</body>

</html>
