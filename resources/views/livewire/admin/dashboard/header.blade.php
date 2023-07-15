<div>
    <div>
        <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
            <div class="header__right d-flex flex-grow-1 item-center">
                <span class="bars"></span>
                <a href="/"><img src="{{ asset('panel/img/Untitled-3.png') }}" alt="" height="60px"
                        width="150px" style="margin-right:20px"></a>
            </div>
            <div class="header__left d-flex flex-end item-center margin-top-2">
                <span class="account-balance font-size-12">موجودی :
                    {{ number_format(\App\Models\bankPayment::where('status', 1)->sum('price')) }} تومان</span>
                <div class="notification margin-15">
                    <a class="notification__icon"></a>
                    <div class="dropdown__notification">
                        @if (
                            \App\Models\commentProduct::where('status', 0)->first() == null &&
                                \App\Models\commentArticle::where('status', 0)->first() == null)

                            <span class="font-size-13">موردی برای نمایش وجود ندارد</span>
                        @else
                            @forelse (\App\Models\commentProduct::where('status',0)->get() as $commPro)
                                <p> کامنت محصولات:</p>


                                <div class="content__notification">
                                    <p>کاربر:
                                        {{ $commPro->user->name ?? $commPro->user->id }}
                                        برای محصول
                                        ({{ $commPro->product->title }})
                                        کامنت گذاشت
                                    </p>

                                </div>
                                <hr>

                            @empty
                                <div></div>
                            @endforelse
                            <br>

                            @foreach (\App\Models\commentArticle::where('status', 0)->get() as $commArt)
                                <p> کامنت مقالات: </p>
                                <div class="content__notification">
                                    <p>کاربر:{{ $commArt->user->name ?? $commArt->user->id }} برای مقاله
                                        ({{ $commArt->article->title }})
                                        کامنت گذاشت
                                    </p>

                                </div>

                            @endforeach
                        @endif
                    </div>
                </div>
                <a href="/" class="logout" title="خروج"></a>
            </div>
        </div>
    </div>

</div>
<div class="breadcrumb">
    <ul>
        <li>
            <a href="{{ Request()->url() }}" title="پیشخوان">پیشخوان |@yield('title')</a>
        </li>
    </ul>
</div>
