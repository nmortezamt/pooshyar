<div>
    <div class="ajax_quick_view">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src="/uploads/{{ $product->img }}" data-zoom-image="/uploads/{{ $product->img }}" alt="{{ $product->title }}">
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                        @forelse ($galleries as $gallery)
                        <div class="item">
                            <a class="product_gallery_item active" data-image="/uploads/{{ $gallery->img }}" data-zoom-image="/uploads/{{ $gallery->img }}">
                                <img src="/uploads/{{ $gallery->img }}" alt="{{ $product->title }}">
                            </a>
                        </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a>{{ $product->title }}</a></h4>
                        <div class="product_price">
                            @if ($product->discount_price)
                            <span class="price">{{ \App\Models\persianNumber::translate(number_format($product->price/100*(100-$product->discount_price))) }} تومان</span>
                            <del>{{ \App\Models\persianNumber::translate(number_format($product->price)) }} تومان</del>
                            <div class="on_sale">
                                <span>{{ \App\Models\persianNumber::translate($product->discount_price )}}% تخفیف</span>
                            </div>
                            @else
                            <span class="price">{{\App\Models\persianNumber::translate( number_format($product->price))}} تومان</span>
                            @endif
                        </div>
                        <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:{{ $rating*20 }}%"></div>
                                </div>
                                <span class="rating_num">({{ $countComment }})</span>
                            </div>
                        <div class="pr_desc">
                            <div>{!! $product->description !!}</div>
                        </div>
                        <div class="product_sort_info">
                            <ul>
                                {{-- <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty</li> --}}
                                @if ($product->number < 10)
                                <li><i class="linearicons-sync"></i> فقط {{ \App\Models\persianNumber::translate($product->number)}} در انبار باقی مانده </li>
                                @endif
                                {{-- <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li> --}}
                            </ul>
                        </div>
                        <div class="pr_switch_wrap">
                            <span class="switch_lable">رنگ</span>
                            <div class="product_color_switch">
                                <div class="product_color_switch">
                                @forelse (\App\Models\color::where('product_id',$product->id)->get() as $color)
                                <span data-color="{{ $color->value }}"></span>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="pr_switch_wrap">
                            <span class="switch_lable">Size</span>
                            <div class="product_size_switch">
                                @forelse (\App\Models\size::where('product_id',$product->id)->get() as $size)
                                <span>{{ $size->name }}</span>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button class="btn btn-fill-out btn-addtocart" type="button"><i class="icon-basket-loaded"></i> به سبد خرید اضافه کنید</button>
                            <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                            <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
                        </div>
                    </div>
                    <hr>
                    <ul class="product-meta">
                        <li>دسته بندی: <a href="{{route('product.category.index', $category->link )}}">{{ $category->title }}</a></li>
                    </ul>

                    <div class="product_share">
                        <span>اشتراک:</span>
                        <ul class="social_icons">
                            @forelse (\App\Models\social::all() as $social)
                            <li><a href="/{{ $social->link }}"><i class="ion-social-{{ $social->type }}"></i></a></li>
                            @empty

                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('pooshyar/assets/js/scripts.js') }}"></script>

</div>
