<!-- START FOOTER -->
<footer class="footer_dark">
	<div class="footer_top">

        @php
        if(isset(\App\Models\logoSite::get()[0]))
        $logo = \App\Models\logoSite::get()[0];
        @endphp
{{--            <img src="/uploads/{{ $logo->img }}" width="150px"  class="responsive-image-footer">--}}

        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                	<div class="widget">
                        @php
                            if(isset(\App\Models\FooterlinkTitle::get()[0]))
                            $footerLinkTitle = \App\Models\FooterlinkTitle::get()[0];
                        @endphp
{{--                        <h6 class="widget_title">{{$footerLinkTitle->page->title }}--}}
{{--                        </h6>--}}
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                @php
                                if(isset(\App\Models\footerTitle::get()[0]))
                                $footer_title = \App\Models\footerTitle::get()[0]
                                @endphp
{{--                              <p>{{ $footer_title->title }}</p>--}}
                            </li>

                            <li>
                                <i class="ti-email"></i>
                                @php
                                if(isset(\App\Models\footerTitle::get()[1]))
                                $footer_title = \App\Models\footerTitle::get()[1]
                               @endphp
{{--                                <a href="mailto:{{ $footer_title->title }}">{{ $footer_title->title }}</a>--}}
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                @php
                                if(isset(\App\Models\footerTitle::get()[2]))
                                $footer_title = \App\Models\footerTitle::get()[2]
                                @endphp
{{--                               <a href="tel:{{ $footer_title->title }}"><p>--}}
{{--                                {{ \App\Models\persianNumber::translate($footer_title->title)}}</p></a>--}}
                            </li>
                        </ul>
                    </div>

                    {{-- STRAT SOCIAL --}}
                    @include('livewire.home.home.setting.footer.footer_social')
                    {{-- END SOCIAL --}}
        		</div>

                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        @php
                        if(isset(\App\Models\FooterlinkTitle::get()[1]))
                        $footerLinkTitle = \App\Models\FooterlinkTitle::get()[1];
                        @endphp
{{--                        <h6 class="widget_title">{{ $footerLinkTitle->page->title }}--}}
{{--                        </h6>--}}
                        <ul class="widget_links">
                            @foreach (\App\Models\FooterlinkOne::all() as $footerOne)
                            <li><a href="{{ url($footerOne->page->link) }}">{{ $footerOne->page->title }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        @php
                        if(isset(\App\Models\FooterlinkTitle::get()[2]))
                        $footerLinkTitle = \App\Models\FooterlinkTitle::get()[2];
                        @endphp
{{--                        <h6 class="widget_title">{{ $footerLinkTitle->page->title }}--}}
{{--                        </h6>--}}
                        <ul class="widget_links">
                            @foreach (\App\Models\FooterlinkTwo::all() as $footerTwo)
                                 <li><a href="{{ url($footerTwo->page->link) }}">{{ $footerTwo->page->title }}
                                 </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                     {{-- STRAT NEWSLETTER --}}
                     @include('livewire.home.home.setting.footer.footer_form')
                     {{-- END NEWSLETTER --}}
                </div>
            </div>
            @php
            if(isset(\App\Models\footerTitle::get()[4]))
            $footer_title = \App\Models\footerTitle::get()[4]
            @endphp
           <article>
{{--            <h3>{{ $footer_title->title }}</h3>--}}
            @php
            if(isset(\App\Models\footerTitle::get()[5]))
            $footer_title = \App\Models\footerTitle::get()[5]
         @endphp
{{--            <p>{{ $footer_title->title }}</p>--}}
           </article>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @php
                    if(isset(\App\Models\footerTitle::get()[6]))
                    $footer_title = \App\Models\footerTitle::get()[6]
                    @endphp
{{--                    <p class="mb-md-0 text-center text-md-left">{{ $footer_title->title }}--}}
{{--                    </p>--}}
                </div>
                <div class="col-md-6">
                    <ul class="footer_payment text-center text-md-right">
                        @foreach (\App\Models\master_card::all() as $master)
                        <li><a href="{{ $master->page->link }}"><img src="/uploads/{{ $master->page->img }}" alt="{{ $master->page->title }}"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

<!-- Latest jQuery -->
<script src="{{ asset('pooshyar/assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- popper min js -->
<script src="{{ asset('pooshyar/assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('pooshyar/assets/js/jquery.ui.slider-rtl.min.js') }}"></script>

<script src="{{ asset('pooshyar/assets/js/popper.min.js') }}"></script>
<!-- Latest compiled and minified Bootstrap -->
<script src="{{ asset('pooshyar/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- owl-carousel min js  -->
<script src="{{ asset('pooshyar/assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<!-- magnific-popup min js  -->
<script src="{{ asset('pooshyar/assets/js/magnific-popup.min.js') }}"></script>
<!-- waypoints min js  -->
<script src="{{ asset('pooshyar/assets/js/waypoints.min.js') }}"></script>
<!-- parallax js  -->
<script src="{{ asset('pooshyar/assets/js/parallax.js') }}"></script>
<!-- countdown js  -->
<script src="{{ asset('pooshyar/assets/js/jquery.countdown.min.js') }}"></script>
<!-- imagesloaded js -->
<script src="{{ asset('pooshyar/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- isotope min js -->
<script src="{{ asset('pooshyar/assets/js/isotope.min.js') }}"></script>
<!-- jquery.dd.min js -->
<script src="{{ asset('pooshyar/assets/js/jquery.dd.min.js') }}"></script>
<!-- slick js -->
<script src="{{ asset('pooshyar/assets/js/slick.min.js') }}"></script>
<!-- elevatezoom js -->
<script src="{{ asset('pooshyar/assets/js/jquery.elevatezoom.js') }}"></script>
<!-- scripts js -->
<script src="{{ asset('pooshyar/assets/js/scripts.js') }}"></script>
