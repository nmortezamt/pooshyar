<div>
    <!-- START HEADER -->
    @include('livewire.home.home.header')
    <!-- END HEADER -->
    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <h1 class="title_product">محصولات :{{ $subcategory->title }}</h1>
                <p>{{ $subcategory->description }}</p>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <div class="product_header">
                                    <div class="product_header_left">
                                        {{-- <div class="custom_select">
                                            <select class="form-control form-control-sm" wire:model='sort_product'>
                                                <option value="order">مرتب سازی پیش فرض
                                                </option>
                                                <option value="popularity">مرتب سازی بر اساس محبوبیت
                                                </option>
                                                <option value="date">مرتب سازی بر اساس جدید بودن
                                                </option>
                                                <option value="price_asc">مرتب سازی بر اساس قیمت: کم به زیاد
                                                </option>
                                                <option value="price-desc">مرتب سازی بر اساس قیمت: زیاد به پایین
                                                </option>
                                            </select>
                                        </div> --}}
                                    </div>
                                    <div class="product_header_right">
                                        <div class="products_view">
                                            <a href="javascript:Void(0);" class="shorting_icon grid"><i
                                                        class="ti-view-grid"></i></a>
                                            <a href="javascript:Void(0);" class="shorting_icon list active"><i
                                                        class="ti-layout-list-thumb"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row shop_container list">
                            @forelse ($products as $product)
                                {{-- php code --}}
                                @php
                                    $countComment = \App\Models\commentProduct::where('product_id',$product->id)->where('status',1)->count();
                                    $sum = \App\Models\commentProduct::where('product_id',$product->id)->where('status',1)->sum('rate');
                                    if($countComment !=null){
                                    $rating = $sum / $countComment;
                                    }else{
                                        $rating = 0;
                                    }
                                @endphp
                                <div wire:key="{{ $product->id }}" class="col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="{{ route('product.single.index',['id'=>$product->id,'link'=>$product->link]) }}">
                                                <img src="/uploads/{{ $product->img }}" alt="{{ $product->title }}"
                                                     class="resize_image">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a
                                                                href="{{ route('product.single.index', ['id'=>$product->id ,'link' =>$product->link])}}"><i
                                                                    class="icon-basket-loaded"></i> مشاهده محصول
                                                        </a></li>

                                                    {{-- <li><a href="{{ route('product.quick.view',$product->id) }}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li> --}}
                                                    {{-- @if (auth()->user())
                                                    @if (\App\Models\favorite::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first())
                                                    <li><a wire:click="remove_wishlist({{ $product->id }})" style="background-color: red"><i class="icon-heart"></i></a></li>
                                                    @else
                                                    <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                    @endif
                                                    @else
                                                    <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                    @endif --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a
                                                        href="{{ route('product.single.index',['id'=>$product->id,'link'=>$product->link]) }}">{{ $product->title }}</a>
                                            </h6>
                                            <div class="product_price">
                                                @if ($product->discount_price)
                                                    <span class="price">{{\App\Models\persianNumber::translate( number_format($product->price/100*(100-$product->discount_price))) }} تومان</span>
                                                    <del>{{\App\Models\persianNumber::translate( number_format($product->price)) }}
                                                        تومان
                                                    </del>
                                                    <div class="on_sale">
                                                        <span>{{ \App\Models\persianNumber::translate($product->discount_price) }}% تخفیف</span>
                                                    </div>
                                                @else
                                                    <span class="price">{{ \App\Models\persianNumber::translate(number_format($product->price))}} تومان</span>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:{{ $rating*20 }}%"></div>
                                                </div>
                                                <span class="rating_num">({{ \App\Models\persianNumber::translate($countComment) }})</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>{!! Str::limit($product->description, 540, '...') !!}</p>
                                            </div>
                                            <div class="pr_switch_wrap" wire:ignore>
                                                <div class="product_color_switch">
                                                    @forelse (\Modules\Product\Color\Models\color::where('product_id',$product->id)->get() as $color)
                                                        <span data-color="{{ $color->value }}"></span>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="list_product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a
                                                                href="{{ route('product.single.index', ['id'=>$product->id ,'link' =>$product->link])}}"><i
                                                                    class="icon-basket-loaded"></i> مشاهده محصول
                                                        </a></li>

                                                    {{-- <li><a href="{{ route('product.quick.view',$product->id) }}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li> --}}
                                                    {{-- @if (auth()->user())
                                                    @if (\App\Models\favorite::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first())
                                                    <li><a wire:click="remove_wishlist({{ $product->id }})" style="color: red"><i class="icon-heart"></i></a></li>
                                                    @else
                                                    <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                    @endif
                                                    @else
                                                    <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                    @endif --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse

                        </div>
                        {{ $products->links('livewire.home.paginate') }}
                    </div>
                    @include('livewire.home.product.content.sidebar')
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
