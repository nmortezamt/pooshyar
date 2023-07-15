<div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
    <div class="sidebar">
        <div class="widget">
            <h5 class="widget_title">پستهای اخیر</h5>
            <ul class="widget_recent_post">
                @forelse (\App\Models\article::where('status',1)->latest()->take(5)->get() as $recent)
                <li>
                    <div wire:key="{{ $recent->id }}" class="post_footer">
                        <div class="post_img">
                            <a href="{{route('article.single.index', $recent->link )}}"><img src="/uploads/{{ $recent->img }}" alt="{{ $recent->title }}"></a>
                        </div>
                        <div class="post_content">
                            <h6><a href="{{ route('article.single.index' , $recent->link )}}">{{ $recent->title }}</a></h6>
                            <p class="small m-0">{{\App\Models\persianNumber::translate( jdate($recent->created_at)->format('%B %d ,%Y')) }}</p>
                        </div>
                    </div>
                </li>
                @empty

                @endforelse

            </ul>
        </div>
        @php
        $banner=\App\Models\specialDiscount::first();
        @endphp
        @if (isset($banner) && $banner->status ==1)
        <div class="widget">
            <div class="shop_banner">
                <div class="banner_img overlay_bg_20">
                    <img src="/uploads/{{ $banner->img }}" alt="{{ $banner->title }}">
                </div>
                <div class="shop_bn_content2 text_white">
                    <h5 class="text-uppercase shop_subtitle">تخفیف ویژه</h5>
                    <h3 class="text-uppercase shop_title">{{ $banner->title }}</h3>
                    <a href="{{ $banner->link }}" class="btn btn-white rounded-0 btn-sm text-uppercase">خرید</a>
                </div>
            </div>
        </div>
        @endif

        {{-- <div class="widget">
            <h5 class="widget_title">tags</h5>
            <div class="tags">
                <a href="#">General</a>
                <a href="#">Design</a>
                <a href="#">jQuery</a>
                <a href="#">Branding</a>
                <a href="#">Modern</a>
                <a href="#">Blog</a>
                <a href="#">Quotes</a>
                <a href="#">Advertisement</a>
            </div>
        </div> --}}
    </div>
</div>
