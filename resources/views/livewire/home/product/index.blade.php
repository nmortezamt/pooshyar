<div>
    <!-- START HEADER -->
    @include('livewire.home.home.header')
    <!-- END HEADER -->
    <div class="main_content">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                        <div class="product-image">
                            <div class="product_img_box" wire:ignore>
                                <img id="product_img" src="/uploads/{{ $product->img }}"
                                     data-zoom-image="/uploads/{{ $product->img }}" alt="{{ $product->title }}">
                                <a class="product_img_zoom" title="گالری">
                                    <span class="linearicons-zoom-in"></span>
                                </a>
                            </div>
                            <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4"
                                 data-slides-to-scroll="1" data-infinite="false" wire:ignore>
                                @forelse ($galleries as $gallery)
                                    <div wire:key="{{ $gallery->id }}" class="item">
                                        <a class="product_gallery_item" data-image="/uploads/{{ $gallery->img }}"
                                           data-zoom-image="/uploads/{{ $gallery->img }}">
                                            <img src="/uploads/{{ $gallery->img }}">
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
                                <h1 class="title_product">{{ $product->title }}</h1>

                                <div class="product_price">
                                    @if ($this->buyType == 'single')
                                        @if ($product->discount_price)
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format(($product->price / 100) * (100 - $product->discount_price))) }}
                                                تومان</span>
                                            <del>{{ \App\Models\persianNumber::translate(number_format($product->price)) }}
                                                تومان
                                            </del>
                                            <div class="on_sale">
                                                <span>{{ \App\Models\persianNumber::translate($product->discount_price) }}%
                                                    تخفیف</span>
                                            </div>
                                        @else
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format($product->price)) }}
                                                تومان</span>
                                        @endif
                                    @elseif ($this->buyType == 'major')
                                        @if ($product->discount_price)
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format(($product->price_major / 100) * (100 - $product->discount_price))) }}
                                                تومان</span>
                                            <del>{{ \App\Models\persianNumber::translate(number_format($product->price_major)) }}
                                                تومان
                                            </del>
                                            <div class="on_sale">
                                                <span>{{ \App\Models\persianNumber::translate($product->discount_price) }}%
                                                    تخفیف</span>
                                            </div>
                                        @else
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format($product->price_major)) }}
                                                تومان</span>
                                        @endif
                                    @endif

                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{ $rating * 20 }}%"></div>
                                    </div>
                                    <span
                                            class="rating_num">({{ \App\Models\persianNumber::translate($countComment) }})</span>
                                </div>

                                <div class="pr_desc">
                                    <div>{!! $product->description !!}</div>
                                </div>
                                <div class="product_sort_info">
                                    <ul>
                                        {{-- <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty
                                        </li> --}}
                                        @if ($product->number < 10 && $product->number >0)
                                            <li class="text-danger"><i class="linearicons-sync"></i> فقط
                                                {{ \App\Models\persianNumber::translate($product->number) }} تا در انبار
                                                باقی مانده
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="pr_switch_wrap">
                                    <div wire:loading.remove wire:target="buyType">
                                        <div class="row">
                                            <div class="radio-group">
                                                <input type="radio" wire:model='buyType' name="buy_type_single"
                                                       id="single-radio" value="single">
                                                <label for="single-radio" class="ml-3">تکی:</label>
                                            </div>
                                        </div>
                                        @php
                                            $qty_color = \Modules\Product\Color\Models\color::where('product_id', $product->id)->count();
                                            $qty_size = \Modules\Product\Size\Models\size::where('product_id', $product->id)->count();
                                            $total_count = $qty_color * $qty_size;
                                        @endphp
                                        @if($product->number >= $total_count)
                                            <div class="row">
                                                <div class="radio-group">
                                                    <input type="radio" wire:model='buyType' name="buy_type_major"
                                                           id="major-radio" value="major">
                                                    <label for="major-radio" class="ml-3">عمده:</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div wire:loading wire:target="buyType">
                                        <i class="fas fa-spinner fa-spin font-search color-load"></i>
                                    </div>

                                    <br>
                                    <span class="switch_lable">رنگ</span>
                                    <div class="product_color_switch" wire:ignore>
                                        @forelse (\Modules\Product\Color\Models\color::where('product_id',$product->id)->get() as $color)
                                            <span data-color="{{ $color->value }}" title="{{ $color->name }}"
                                                  wire:click="color({{ $color->id }})"></span>
                                            <div wire:loading wire:target="color({{ $color->id }})">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                                <div class="pr_switch_wrap">
                                    <span class="switch_lable">سایز</span>
                                    <div class="product_size_switch" wire:ignore>
                                        @forelse(\Modules\Product\Size\Models\size::where('product_id',$product->id)->get() as $size)
                                            <span wire:click="size({{ $size->id }})">{{ $size->name }}</span>
                                            <div wire:loading wire:target="size({{ $size->id }})">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="cart_extra">
                                @if ($product->shipment == 1 && $product->number > 0)
                                    @if (!$caart)
                                        <div class="cart-product-quantity">
                                            <div class="quantity">
                                                <button class="min_qty" wire:click='removeOfCount'>-</button>
                                                <span wire:loading wire:target="removeOfCount">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>
                                                @if ($this->buyType == 'single')
                                                    <input type="text" name="quantity"
                                                           value="{{ $this->countSingle }}" title="تعداد" class="qty"
                                                           size="4" disabled>
                                                @elseif($this->buyType == 'major')
                                                    <input type="text" name="quantity"
                                                           value="{{ $this->countMajor }}" title="تعداد" class="qty"
                                                           size="4" disabled>
                                                @endif

                                                <button class="plu" wire:click='addToCount'>+</button>
                                                <span wire:loading wire:target="addToCount">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>

                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('cart.index') }}"><i class="icon-basket-loaded"></i> مشاهده
                                            سبد
                                            خرید</a>
                                    @endif
                                    <div class="cart_btn">&nbsp;&nbsp;
                                        @if ($caart)
                                            <button class="btn btn-fill-out btn-addtocart" type="button"
                                                    wire:click="removeOfCart({{ $caart->id }})"><i
                                                        class="icon-trash"></i> حذف از
                                                سبد خرید
                                                <div wire:loading wire:target="removeOfCart({{ $caart->id }})">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>

                                            </button>
                                        @else
                                            <button class="btn btn-fill-out btn-addtocart" type="button"
                                                    wire:click="addToCart({{ $product->id }})"><i
                                                        class="icon-basket-loaded"></i> به
                                                سبد خرید اضافه کنید
                                                <div wire:loading wire:target="addToCart">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                            </button>
                                        @endif

                                        @if (auth()->user() &&
                                                \App\Models\favorite::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first())
                                            <a class="add_wishlist" style="color:red"
                                               wire:click="remove_wishlist({{ $product->id }})"
                                               title="حذف از علاقه مندی ">
                                                <div wire:loading wire:target="remove_wishlist">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                                <div wire:loading.remove wire:target="remove_wishlist">
                                                    <i class="fa fa-heart font-heart"></i>
                                                </div>
                                            </a>
                                        @else
                                            <a class="add_wishlist" wire:click="add_favorite({{ $product->id }})"
                                               title="افزودن به علاقه مندی">
                                                <span wire:loading wire:target="add_favorite">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>
                                                <span wire:loading.remove wire:target="add_favorite">
                                                    <i class="icon-heart font-heart"></i>
                                                </span>
                                            </a>
                                        @endif

                                    </div>
                                @else
                                    <button class="btn btn-fill-out btn-addtocart" type="button" disabled> محصول
                                        موجود نمی باشد
                                    </button>
                                @endif
                            </div>
                            @if ($product->shipment == 1 && $product->number > 0)
                                <br>
                                <p>
                                    @if ($this->buyType == 'single')
                                        @if ($product->discount_price)
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format(($product->price / 100) * (100 - $product->discount_price) * $this->countSingle)) }}
                                                تومان برای
                                                {{ \App\Models\persianNumber::translate(number_format($this->countSingle)) }}
                                                مورد</span>
                                            <del>{{ \App\Models\persianNumber::translate(number_format($product->price)) }}
                                                تومان
                                            </del> &nbsp;
                                            <span
                                                    class="on_sale">{{ \App\Models\persianNumber::translate($product->discount_price) }}%
                                                تخفیف</span>
                                        @else
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format($product->price * $this->countSingle)) }}
                                                تومان برای
                                                {{ \App\Models\persianNumber::translate(number_format($this->countSingle)) }}مورد
                                            </span>
                                        @endif
                                    @elseif ($this->buyType == 'major')
                                        @if ($product->discount_price)
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format(($product->price_major / 100) * (100 - $product->discount_price) * $this->countMajor)) }}
                                                تومان برای
                                                {{ \App\Models\persianNumber::translate(number_format($this->countMajor)) }}
                                                مورد</span>
                                            <del>{{ \App\Models\persianNumber::translate(number_format($product->price_major)) }}
                                                تومان
                                            </del> &nbsp;
                                            <span
                                                    class="on_sale">{{ \App\Models\persianNumber::translate($product->discount_price) }}%
                                                تخفیف</span>
                                        @else
                                            <span
                                                    class="price">{{ \App\Models\persianNumber::translate(number_format($product->price_major * $this->countMajor)) }}
                                                تومان برای
                                                {{ \App\Models\persianNumber::translate(number_format($this->countMajor)) }}مورد
                                            </span>
                                        @endif

                                    @endif
                                </p>
                            @endif

                            <hr>
                            <ul class="product-meta">
                                <li>دسته بندی: <a
                                            href="{{ route('product.category.index', $category->link) }}">{{ $category->title }}</a>
                                </li>
                            </ul>

                            <div class="product_share">
                                <span>اشتراک:</span>
                                <ul class="social_icons">

                                    <li>
                                        <a href="tg://msg_url?url={{ route('product.single.index', ['id' => $product->id, 'link' => $product->link]) }}&text={{ $product->title }}"
                                           class="sc_telegram"><i class="fab fa-telegram"></i></a></li>

                                    <li>
                                        <a href="https://www.instagram.com/?url={{ route('product.single.index', ['id' => $product->id, 'link' => $product->link]) }}"
                                           class="sc_instagram"><i class="fab fa-instagram"></i></a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="large_divider clearfix"></div>
                    </div>
                </div>
                <div class="row" wire:ignore>
                    <div class="col-12">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-toggle="tab"
                                       href="#Description" role="tab" aria-controls="Description"
                                       aria-selected="true">توضیحات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-toggle="tab"
                                       href="#Additional-info" role="tab" aria-controls="Additional-info"
                                       aria-selected="false">مشخصات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews"
                                       role="tab" aria-controls="Reviews" aria-selected="false">دیدگاه
                                        ({{ \App\Models\persianNumber::translate($countComment) }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab">
                                <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                     aria-labelledby="Description-tab" wire:ignore>
                                    <div>{!! $product->body !!}</div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info" role="tabpanel"
                                     aria-labelledby="Additional-info-tab" wire:ignore>
                                    <table class="table table-bordered">
                                        @forelse(\App\Models\attributeValue::where('product_id',$product->id)->get() as $attribute)
                                            <tr>
                                                <td>{{ $attribute->attribute->title }}</td>
                                                <td>{{ $attribute->value }}</td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </table>
                                </div>
                                @include('livewire.home.product.content.comment')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="small_divider"></div>
                        <div class="divider"></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                @include('livewire.home.product.content.releted-product')
            </div>
        </div>
    </div>
</div>
