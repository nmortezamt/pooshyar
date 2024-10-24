<div>
    <!-- START HEADER -->
    @include('livewire.home.home.header')
    <!-- END HEADER -->
    <div class="main_content">
        <div class="section">
            <div class="container">
                @php
                    if (auth()->user()) {
                        $cart_is = \App\Models\cart::where('user_id', auth()->user()->id)->where('status', 0)->first();

                    } else {
                        $session_cart = Illuminate\Support\Facades\Session::get('cart');
                        if(!empty($session_cart)){
                            $cart_is = $session_cart;
                        }else{
                            $cart_is = null;
                        }
                    }
                @endphp
                @if (isset($cart_is))
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive shop_cart_table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">محصول</th>
                                        <th class="product-name">نوع خرید</th>
                                        <th class="product-name">رنگ</th>
                                        <th class="product-name">سایز</th>
                                        <th class="product-price">قیمت</th>
                                        <th class="product-quantity">تعداد</th>
                                        <th class="product-subtotal">مجموع</th>
                                        <th class="product-subtotal">زمان ارسال</th>
                                        <th class="product-remove">حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (auth()->user())
                                        {{-- carts have user --}}
                                        @forelse ($carts as $cart)
                                            <tr wire:key="{{ $cart->id }}">
                                                <td class="product-thumbnail">
                                                    <a
                                                        href="{{ route('product.single.index',['id'=>$cart->product->id,'link'=>$cart->product->link])  }}">
                                                        <img src="/uploads/{{ $cart->product->img }}"
                                                             alt="{{ $cart->product->title }}"></a>
                                                </td>
                                                <td class="product-name" data-title="محصول"><a
                                                        href="{{ route('product.single.index',['id'=>$cart->product->id,'link'=>$cart->product->link])}}">{{
                                                $cart->product->title }}</a></td>

                                                @if ($cart->type == 'single')
                                                    <td class="product-name" data-title="نوع خرید"><a
                                                        >تکی</a></td>
                                                @else
                                                    <td class="product-name" data-title="نوع خرید"><a
                                                        >عمده</a></td>
                                                @endif


                                                <td class="product-name" data-title="رنگ">
                                                    <div class="pr_switch_wrap" wire:ignore>
                                                        <div class="product_color_switch">
                                                            @if ($cart->type
                                                             == 'single')
                                                                @php
                                                                    $color_name = json_decode($cart->color_id,true);
                                                                    foreach ($color_name as $name => $id) {
                                                                        $value_color = \Modules\Product\Color\Models\color::where('id',$id)->first();
                                                                        $name_color = \Modules\Product\Color\Models\color::where('id',$id)->first();
                                                                    }
                                                                @endphp
                                                                <span data-color="{{ $value_color->value ?? '' }}"
                                                                      title="{{ $name_color->name ?? ''}}"></span>
                                                            @else

                                                                @forelse (\Modules\Product\Color\Models\color::where('product_id',$cart->product_id)->get() as $color)
                                                                    <span data-color="{{ $color->value ?? '' }}"
                                                                          title="{{ $color->name ?? ''}}"></span>
                                                                @empty

                                                                @endforelse
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="product-name" data-title="سایز">
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_size_switch">
                                                            @if ($cart->type == 'single')
                                                                @php
                                                                    $size_name = json_decode($cart->size_id,true);
                                                                    foreach ($size_name as $name => $id) {
                                                                       $NameSize = $name;
                                                                    }
                                                                @endphp
                                                                <span>{{ $NameSize }}</span>
                                                            @else
                                                                @forelse (\Modules\Product\Size\Models\size::where('product_id',$cart->product_id)->get() as $size)
                                                                    <span>{{ $size->name ?? ''}}</span>
                                                                @empty

                                                                @endforelse

                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="product-price" data-title="قیمت">
                                                    @if ($cart->product_price_discount)
                                                        <span class="price">{{
                                                \App\Models\persianNumber::translate(number_format($cart->product_price_discount))}} تومان</span>
                                                        <del>{{ \App\Models\persianNumber::translate(number_format($cart->product_price)) }}
                                                            تومان
                                                        </del>
                                                    @else
                                                        <span class="price">{{ \App\Models\persianNumber::translate(number_format($cart->product_price))}} تومان</span>
                                                    @endif

                                                </td>
                                                <td class="product-quantity" data-title="تعداد">
                                                    <div class="quantity">
                                                        <button type="button" class="minus"
                                                                wire:click="removeToCount({{ $cart->id }})">-
                                                        </button>
                                                        <div wire:loading wire:target="removeToCount({{ $cart->id }})">
                                                            <i class="fas fa-spinner fa-spin"></i>
                                                        </div>
                                                        <input type="text" name="quantity"
                                                               value="{{ \App\Models\persianNumber::translate($cart->count) }}"
                                                               title="تعداد" class="qty" size="4" disabled>
                                                        <button class="plu" wire:click="addToCount({{ $cart->id }})">+
                                                        </button>
                                                        <div wire:loading wire:target="addToCount({{ $cart->id }})">
                                                            <i class="fas fa-spinner fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" data-title="مجموع">

                                            <span class="price">
                                                {{\App\Models\persianNumber::translate(number_format($cart->total_price))}} تومان</span>

                                                </td>

                                                <td class="product-name" data-title="زمان ارسال">
                                                    @if ($cart->product->time == 0)
                                                        ارسال پوشیار
                                                    @else
                                                        {{ $cart->product->time }}روزکاری دیگر
                                                    @endif
                                                </td>

                                                <td class="product-remove" wire:click='removeCart({{ $cart->id }})'
                                                    data-title="حذف">
                                                    <div wire:loading wire:target="removeCart({{ $cart->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </div>
                                                    <span wire:loading.remove wire:target="removeCart({{ $cart->id }})">
                                                <i class="ti-close"></i>
                                            </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <div>سبد خرید خالی است</div>
                                        @endforelse

                                        {{-- carts have session --}}
                                    @else

                                        @forelse ($carts as $cart)
                                            @php
                                                $product = \Modules\Product\Product\Models\product::where('id',$cart['product_id'])->first();
                                            @endphp
                                            <tr wire:key="{{ $cart['id'] }}">
                                                <td class="product-thumbnail">
                                                    <a
                                                        href="{{ route('product.single.index',['id'=>$product->id,'link'=>$product->link])  }}">
                                                        <img src="/uploads/{{ $product->img }}"
                                                             alt="{{ $product->title }}"></a>
                                                </td>
                                                <td class="product-name" data-title="محصول"><a
                                                        href="{{ route('product.single.index',['id'=>$product->id,'link'=>$product->link])}}">{{
                                                $product->title }}</a></td>

                                                @if ($cart['type'] == 'single')
                                                    <td class="product-name" data-title="نوع خرید"><a
                                                        >تکی</a></td>
                                                @else
                                                    <td class="product-name" data-title="نوع خرید"><a
                                                        >عمده</a></td>
                                                @endif


                                                <td class="product-name" data-title="رنگ">
                                                    <div class="pr_switch_wrap" wire:ignore>
                                                        <div class="product_color_switch">
                                                            @if ($cart['type']
                                                             == 'single')
                                                                @php
                                                                    $color_name = json_decode($cart['color_id'],true);
                                                                    foreach ($color_name as $name => $id) {
                                                                        $value_color = \Modules\Product\Color\Models\color::where('id',$id)->first();
                                                                        $name_color = \Modules\Product\Color\Models\color::where('id',$id)->first();
                                                                    }
                                                                @endphp
                                                                <span data-color="{{ $value_color->value ?? '' }}"
                                                                      title="{{ $name_color->name ?? ''}}"></span>
                                                            @else

                                                                @forelse (\Modules\Product\Color\Models\color::where('product_id',$cart['product_id'])->get() as $color)
                                                                    <span data-color="{{ $color->value ?? '' }}"
                                                                          title="{{ $color->name ?? ''}}"></span>
                                                                @empty

                                                                @endforelse
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="product-name" data-title="سایز">
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_size_switch">
                                                            @if ($cart['type'] == 'single')
                                                                @php
                                                                    $size_name = json_decode($cart['size_id'],true);
                                                                    foreach ($size_name as $name => $id) {
                                                                       $NameSize = $name;
                                                                    }
                                                                @endphp
                                                                <span>{{ $NameSize }}</span>
                                                            @else
                                                                @forelse (\Modules\Product\Size\Models\size::where('product_id',$cart['product_id'])->get() as $size)
                                                                    <span>{{ $size->name ?? ''}}</span>
                                                                @empty

                                                                @endforelse

                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="product-price" data-title="قیمت">
                                                    @if ($cart['product_price_discount'])
                                                        <span class="price">{{
                                                \App\Models\persianNumber::translate(number_format($cart['product_price_discount']))}} تومان</span>
                                                        <del>{{ \App\Models\persianNumber::translate(number_format($cart['product_price'])) }}
                                                            تومان
                                                        </del>
                                                    @else
                                                        <span class="price">{{ \App\Models\persianNumber::translate(number_format($cart['product_price']))}} تومان</span>
                                                    @endif

                                                </td>
                                                <td class="product-quantity" data-title="تعداد">
                                                    <div class="quantity">
                                                        <button type="button" class="minus"
                                                                wire:click="removeToCount({{ $cart['id'] }})">-
                                                        </button>
                                                        <div wire:loading
                                                             wire:target="removeToCount({{ $cart['id'] }})">
                                                            <i class="fas fa-spinner fa-spin"></i>
                                                        </div>
                                                        <input type="text" name="quantity"
                                                               value="{{ \App\Models\persianNumber::translate($cart['count']) }}"
                                                               title="تعداد" class="qty" size="4" disabled>
                                                        <button class="plu" wire:click="addToCount({{ $cart['id'] }})">
                                                            +
                                                        </button>
                                                        <div wire:loading wire:target="addToCount({{ $cart['id'] }})">
                                                            <i class="fas fa-spinner fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" data-title="مجموع">

                                            <span class="price">
                                                {{\App\Models\persianNumber::translate(number_format($cart['total_price']))}} تومان</span>

                                                </td>

                                                <td class="product-name" data-title="زمان ارسال">
                                                    @if ($product->time == 0)
                                                        ارسال پوشیار
                                                    @else
                                                        {{ $product->time }}روزکاری دیگر
                                                    @endif
                                                </td>

                                                <td class="product-remove" wire:click='removeCart({{ $cart['id'] }})'
                                                    data-title="حذف">
                                                    <div wire:loading wire:target="removeCart({{ $cart['id'] }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </div>
                                                    <span wire:loading.remove
                                                          wire:target="removeCart({{ $cart['id'] }})">
                                                <i class="ti-close"></i>
                                            </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <div>سبد خرید خالی است</div>
                                        @endforelse

                                    @endif

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="medium_divider"></div>
                            <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                            <div class="medium_divider"></div>
                        </div>
                    </div>
                    @include('livewire.home.cart.content.calculate')
                @else
                    <div>
                        <h4 class="text-center">سبد خرید خالی می باشد</h4>
                        <a href="{{ route('product.all') }}"><img
                                src="{{ asset('pooshyar/assets/images/add-to-basket-3d-illustration-png.png') }}"
                                alt="سبد خرید خالی" class="center_img"></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
