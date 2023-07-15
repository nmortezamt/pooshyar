<!-- START SECTION SHOP -->
<div class="section small_pt" wire:ignore>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>محصولات پرطرفدار</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                    @forelse (\App\Models\product::where('status',1)->where('view','>=',1)->get() as $product)
                    @php

                    $gallery = \App\Models\gallery::where('product_id',$product->id)->first();
                    $countComment = \App\Models\commentProduct::where('product_id',$product->id)->where('status',1)->count();
                    $sum = \App\Models\commentProduct::where('product_id',$product->id)->where('status',1)->sum('rate');
                    if($countComment !=null){
                    $rating = $sum / $countComment;
                    }else{
                        $rating = 0;
                    }
                    @endphp
                    <div wire:key="{{ $product->id }}" class="item">
                        <div class="product_wrap">
                            <div class="product_img">
                                <a href="{{ route('product.single.index', ['id'=>$product->id ,'link' =>$product->link])}}">
                                    <img src="/uploads/{{ $product->img}}" alt="{{ $product->title }}" class="resize_image">
                                    <img class="resize_image product_hover_img" src="/uploads/{{ $gallery->img ?? ''}}" alt="{{ $product->title }}">
                                </a>
                                {{-- <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="{{ route('product.single.index', ['id'=>$product->id ,'link' =>$product->link])}}"><i class="icon-basket-loaded"></i> افزودن به سبد خرید</a></li>

                                        <li wire:ignore><a href="{{ route('product.quick.view',$product->id) }}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                        @if (auth()->user())
                                            @if (\App\Models\favorite::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first())
                                            <li><a wire:click="remove_wishlist({{ $product->id }})" style="background-color: red"><i class="icon-heart"></i></a></li>
                                            @else
                                            <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                            @endif
                                            @else
                                            <li><a wire:click="add_wishlist({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                            @endif
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{ route('product.single.index', ['id'=>$product->id ,'link' =>$product->link])}}">{{ $product->title }}</a></h6>
                                <div class="product_price">
                                    @if($product->discount_price)
                                    <span class="price">
                                        {{\App\Models\persianNumber::translate(number_format($product->price/100*(100-$product->discount_price))) }} تومان </span>
                                    <del>{{ \App\Models\persianNumber::translate(number_format($product->price)) }} تومان </del>
                                    <div class="on_sale">
                                        <span>{{ '%'. \App\Models\persianNumber::translate(number_format($product->discount_price)) }}</span>
                                    </div>
                                    @else
                                    <span class="price">{{ \App\Models\persianNumber::translate(number_format($product->price)) }} تومان </span>
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
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
