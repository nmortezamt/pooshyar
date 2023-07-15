{{-- code php for header --}}
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
    {{-- <div class="top-header light_skin bg_dark d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="header_topbar_info">
                        <div class="header_offer">
                            <span>Free Ground Shipping Over $250</span>
                        </div>
                        <div class="download_wrap">
                            <span class="mr-3">Download App</span>
                            <ul class="icon_list text-center text-lg-left">
                                <li><a href="#"><i class="fab fa-apple"></i></a></li>
                                <li><a href="#"><i class="fab fa-android"></i></a></li>
                                <li><a href="#"><i class="fab fa-windows"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="lng_dropdown">
                            <select name="countries" class="custome_select">
                                <option value='en' data-image="assets/images/eng.png" data-title="English">English
                                </option>
                                <option value='fn' data-image="assets/images/fn.png" data-title="France">France</option>
                                <option value='us' data-image="assets/images/us.png" data-title="United States">United
                                    States</option>
                            </select>
                        </div>
                        <div class="ml-3">
                            <select name="countries" class="custome_select">
                                <option value='USD' data-title="USD">USD</option>
                                <option value='EUR' data-title="EUR">EUR</option>
                                <option value='GBR' data-title="GBR">GBR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/uploads/{{ $logo->img }}" alt="{{ env('APP_NAME') }}">
                    <img class="logo_dark" src="/uploads/{{ $logo->img }}" alt="logo" width="150px">
                </a>
                @include('livewire.home.home.search')

                <ul class="navbar-nav attr-nav align-items-center">

                    @if (auth()->user())
                        <li><a href="{{ route('profile.index') }}" class="nav-link"><i class="linearicons-user"></i></a>
                        </li>
                        @if (auth()->user()->admin || auth()->user()->staff)
                            <li><a href="{{ route('admin.index') }}" class="nav-link">ورود به پنل</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login.register.index') }}" class="nav-link"><i class="icon-login"></i>
                                ورود|ثبت نام</a></li>
                    @endif


                    @if (auth()->user())
                        <li><a href="{{ route('profile.favorites') }}" class="nav-link"><i
                                    class="linearicons-heart"></i><span
                                    class="wishlist_count">{{ \App\Models\persianNumber::translate(\App\Models\favorite::where('user_id', auth()->user()->id)->count())}}</span></a>
                        </li>
                    @endif

                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger"
                         href="#"
                            data-toggle="dropdown"><i class="linearicons-bag2"></i><span class="cart_count">
                                @if (auth()->user())
                                    {{ \App\Models\persianNumber::translate(number_format($carts->count())) }}
                                @elseif (!empty($carts))
                                    {{ \App\Models\persianNumber::translate(number_format(count($carts))) }}
                                @else
                                    ۰
                                @endif
                            </span></a>
                        @if (auth()->user())
                        @if (isset($carts[0]->id))
                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    @forelse ($carts as $cart)
                                        <li>
                                            <a wire:click='removeCart({{ $cart->id }})' class="item_remove">
                                                <div wire:loading wire:target="removeCart({{ $cart->id }})">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                                <span wire:loading.remove
                                                    wire:target="removeCart({{ $cart->id }})">
                                                    <i class="ti-close"></i>
                                                </span>
                                            </a>

                                            <a
                                                href="{{ route('product.single.index', ['id' => $cart->product->id, 'link' => $cart->product->link]) }}"><img
                                                    src="/uploads/{{ $cart->product->img }}"
                                                    alt="{{ $cart->product->title }}">{{ $cart->product->title }}</a>
                                            <span class="cart_quantity"><span
                                                    class="cart_amount"></span>{{ \App\Models\persianNumber::translate(number_format($cart->product_price)) }}<span
                                                    class="price_symbole">x{{ \App\Models\persianNumber::translate(number_format($cart->count)) }}تومان
                                                </span></span>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_total"><strong>مجموع:</strong> <span class="cart_price"> <span
                                                class="price_symbole">تومان</span></span>{{ \App\Models\persianNumber::translate(number_format($carts->sum('total_price'))) }}
                                    </p>
                                    <p class="cart_buttons"><a href="{{ route('cart.index') }}"
                                            class="btn btn-fill-line view-cart">مشاهده سبد خرید</a>
                                        @if (isset($carts[0]->id) && !Request::routeIs('order.index'))
                                            <a wire:click='orderForm'
                                                class="btn btn-fill-out checkout text-white">پرداخت</a>
                                        @endif

                                    </p>
                                </div>

                            </div>
                            @else
                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    <h5 class="title_cart_null">سبد خرید خالی می باشد</h5>
                                    <li>
                                        <img src="{{ asset('pooshyar/assets/images/add-to-basket-3d-illustration-png.png') }}"
                                            alt="سبد خرید خالی" class="img_cart_list">

                                    </li>

                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_buttons"><a href="{{ route('cart.index') }}"
                                            class="btn btn-fill-line view-cart">مشاهده سبد خرید</a>
                                    </p>
                                </div>

                            </div>
                        @endif

                        @elseif (!empty($carts))
                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    @forelse ($carts as $cart)
                                        @php
                                            $product = \App\Models\product::where('id', $cart['product_id'])->first();
                                        @endphp
                                        <li>
                                            <a wire:click='removeCart({{ $cart['id'] }})' class="item_remove">
                                                <div wire:loading wire:target="removeCart({{ $cart['id'] }})">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                                <span wire:loading.remove
                                                    wire:target="removeCart({{ $cart['id'] }})">
                                                    <i class="ti-close"></i>
                                                </span>
                                            </a>

                                            <a
                                                href="{{ route('product.single.index', ['id' => $cart['product_id'], 'link' => $product->link]) }}"><img
                                                    src="/uploads/{{ $product->img }}"
                                                    alt="{{ $product->title }}">{{ $product->title }}</a>
                                            <span class="cart_quantity"><span
                                                    class="cart_amount"></span>{{ \App\Models\persianNumber::translate(number_format($cart['product_price'])) }}<span
                                                    class="price_symbole">x{{ \App\Models\persianNumber::translate(number_format($cart['count'])) }}تومان
                                                </span></span>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                                @php
                                    $total_price_cart = 0;
                                    foreach ($carts as $cart) {
                                        $total_price_cart += $cart['total_price'];
                                    }
                                @endphp
                                <div class="cart_footer">
                                    <p class="cart_total"><strong>مجموع:</strong> <span class="cart_price"> <span
                                                class="price_symbole">تومان</span></span>{{ \App\Models\persianNumber::translate(number_format($total_price_cart)) }}
                                    </p>
                                    <p class="cart_buttons"><a href="{{ route('cart.index') }}"
                                            class="btn btn-fill-line view-cart">مشاهده سبد خرید</a>
                                        @if (isset($carts) && !Request::routeIs('order.index'))
                                            <a wire:click='orderForm'
                                                class="btn btn-fill-out checkout text-white">پرداخت</a>
                                        @endif

                                    </p>
                                </div>

                            </div>
                        @else
                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    <h5 class="title_cart_null">سبد خرید خالی می باشد</h5>
                                    <li>
                                        <img src="{{ asset('pooshyar/assets/images/add-to-basket-3d-illustration-png.png') }}"
                                            alt="سبد خرید خالی" class="img_cart_list">

                                    </li>

                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_buttons"><a href="{{ route('cart.index') }}"
                                            class="btn btn-fill-line view-cart">مشاهده سبد خرید</a>
                                    </p>
                                </div>

                            </div>
                        @endif
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
                            <span>{{ $menu4->title ?? '' }}</span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse">
                            <ul>
                                @foreach (\App\Models\category::where('status', 1)->take(10)->get() as $category)
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

                                {{-- <li><a class="dropdown-item nav-link nav_item" href="coming-soon.html"><i class="flaticon-headphones"></i> <span>Headphones</span></a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="404.html"><i class="flaticon-console"></i> <span>Gaming</span></a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="login.html"><i class="flaticon-watch"></i> <span>Watches</span></a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="register.html"><i class="flaticon-music-system"></i> <span>Home Audio & Theater</span></a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="coming-soon.html"><i class="flaticon-monitor"></i> <span>TV & Smart Box</span></a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="404.html"><i class="flaticon-printer"></i> <span>Printer</span></a></li> --}}
                                @if (\App\Models\category::count() > 9)
                                    <li>
                                        <ul class="more_slide_open">
                                            @foreach (\App\Models\category::where('status', 1)->where('id', '>', 10)->get() as $moreCategory)
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
                            @if (\App\Models\category::count() > 9)
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

                                <li><a class="nav-link nav_item {{ Request::routeIs('product.all', 'product.category.index', 'product.subcategory.index', 'product.single.index') ? 'active' : '' }}"
                                        href=" {{ route('product.all') }}">{{ $menu2->title ?? '' }}</a></li>

                                <li><a class="nav-link nav_item {{ Request::routeIs('article.all.index', 'article.single.index', 'article.category.index', 'article.subcategory.index') ? 'active' : '' }}"
                                        href="{{ route('article.all.index') }}">{{ $menu3->title ?? '' }}</a></li>
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
