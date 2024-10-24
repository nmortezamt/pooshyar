<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap" wire:ignore>
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
        <div class="carousel-inner">
            @forelse (\Modules\Banner\Models\Banner::where('status',1)->get() as $banner)
                @if ($loop->first)
                    <div wire:key="{{ $banner->id }}" class="carousel-item background_bg active"
                         data-img-src="/uploads/{{$banner->img}}">
                        @else
                            <div class="carousel-item background_bg" data-img-src="/uploads/{{$banner->img}}">
                                @endif
                                <div class="banner_slide_content banner_content_inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-7 col-10">
                                                <div class="banner_content overflow-hidden">
                                                    <h2 class="staggered-animation" data-animation="slideInRight"
                                                        data-animation-delay="0.3s">{{ $banner->title }}</h2>
                                                    <h5 class="mb-3 mb-sm-4 staggered-animation font-weight-light"
                                                        data-animation="slideInRight"
                                                        data-animation-delay="1s">{{ $banner->description }}
                                                        {{-- <span class="text_default">50%</span> --}}
                                                    </h5>
                                                    <a class="btn btn-fill-out staggered-animation text-uppercase"
                                                       href="{{ $banner->link }}" data-animation="slideInRight"
                                                       data-animation-delay="1.5s">مشاهده</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div>بنری وجود ندارد</div>
                            @endforelse
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i
                            class="ion-chevron-left"></i></a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i
                            class="ion-chevron-right"></i></a>
        </div>
    </div>
    <!-- END SECTION BANNER -->
