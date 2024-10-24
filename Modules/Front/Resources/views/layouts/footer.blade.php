<footer class="footer_dark">
    <div class="footer_top">
        <img src="/{{ $generalSetting->logo }}" width="150px"  class="responsive-image-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget">
                        <h6 class="widget_title">footer one</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{$generalSetting->address}}</p>
                            </li>

                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:{{ $generalSetting->support_email }}">{{ $generalSetting->support_email }}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <a href="tel:{{ $generalSetting->support_phone_number }}">
                                    <p>
                                        {{ \Modules\Shared\Common\Helpers::convertNumbersToPersian($generalSetting->support_phone_number) }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="widget">
                        <ul class="social_icons rounded_social">
                            <li><a href="{{$generalSetting->instagram_url}}" target="_blank" class="sc_instagram"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{$generalSetting->telegram_url}}" target="_blank" class="sc_telegram"><i class="fab fa-telegram"></i></a></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">footer two</h6>
                        <ul class="widget_links">
                            <li><a href="test">footer two test</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="widget" id="footer">
                            <h6 class="widget_title">footer five</h6>
                            <p>footer five test</p>
                        <div class="newsletter_form rounded_input">
                            <form action="{{ route('post.newletter') }}" method="POST">
                                @csrf
                                <input type="email" name="email" class="form-control" placeholder="ادرس ایمیل را وارد کن" required>
                                <button type="submit" class="btn-send" name="submit" value="Submit"><i class="icon-envelope-letter"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=498361&Code=VpXNYcZfGtSeGxGRQ2mZM3y3rLJWVgjt'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=498361&Code=VpXNYcZfGtSeGxGRQ2mZM3y3rLJWVgjt' alt='' style='cursor:pointer' code='VpXNYcZfGtSeGxGRQ2mZM3y3rLJWVgjt'></a>
                    </div>
                </div>
            </div>
            <article>
                <h3>testtt  t</h3>
                <p>i know </p>
            </article>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0 text-center text-md-left">what is </p>
                </div>
                <div class="col-md-6">
                    <ul class="footer_payment text-center text-md-right">
{{--                        <li><a href="{{ $master->page->link }}"><img src="/uploads/{{ $master->page->img }}" alt="{{ $master->page->title }}"></a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ui.slider-rtl.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/parallax.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dd.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
