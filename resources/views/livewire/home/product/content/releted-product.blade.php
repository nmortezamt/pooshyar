<div wire:ignore>
    <div class="row">
        <div class="col-12">
            <div class="heading_s1">
                <h3>محصولات مرتبط</h3>
            </div>
            <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20"
                 data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                @forelse (\Modules\Product\Product\Models\product::where('status',1)->where('category_id',$category->id)->where('id','<>',$product->id)->latest()->take(20)->get() as $proReleted)
                    @php
                        $countCommentRelated =
                        \App\Models\commentProduct::where('product_id',$proReleted->id)->where('status',1)->count();
                        $sumRelated = \App\Models\commentProduct::where('product_id',$proReleted->id)->where('status',1)->sum('rate');
                        if($countCommentRelated != null){
                        $ratingReleted = $sumRelated / $countCommentRelated;
                        }else{
                        $ratingReleted = 0;
                        }
                    @endphp
                    <div class="item">
                        <div class="product">
                            <div class="product_img">
                                <a href="{{ route('product.single.index',['id'=>$proReleted->id,'link'=>$proReleted->link]) }}">
                                    <img src="/uploads/{{ $proReleted->img }}" alt="{{ $proReleted->title }}"
                                         class="resize_image">
                                </a>
                                {{-- <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> افزودن به سبد خرید</a></li>

                                        <li><a href="{{ route('product.quick.view',$product->id) }}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                        @if (auth()->user())
                                        @if (\App\Models\favorite::where('user_id',auth()->user()->id)->where('product_id',$proReleted->id)->first())
                                        <li><a wire:click='remove_wishlist_releted({{ $proReleted->id }})' style="background-color: red"><i class="icon-heart"></i></a></li>
                                        @else
                                        <li><a wire:click='add_wishlist_releted({{ $proReleted->id }})'><i class="icon-heart"></i></a></li>
                                        @endif
                                        @else
                                        <li><a wire:click='add_wishlist_releted({{ $proReleted->id }})'><i class="icon-heart"></i></a></li>
                                        @endif
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a
                                            href="{{ route('product.single.index',['id'=>$proReleted->id,'link'=>$proReleted->link]) }}">{{ $proReleted->title }}</a>
                                </h6>

                                <div class="product_price">
                                    @if ($proReleted->discount_price)
                                        <span class="price">{{ \App\Models\persianNumber::translate(number_format($proReleted->price/100*(100-$proReleted->discount_price))) }} تومان</span>
                                        <del>{{ \App\Models\persianNumber::translate(number_format($proReleted->price)) }}
                                            تومان
                                        </del>
                                        <div class="on_sale">
                                            <span>{{\App\Models\persianNumber::translate( $proReleted->discount_price) }}% تخفیف</span>
                                        </div>
                                    @else
                                        <span class="price">{{ \App\Models\persianNumber::translate(number_format($proReleted->price))}} تومان</span>
                                    @endif
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:{{ $ratingReleted*20 }}%"></div>
                                    </div>
                                    <span class="rating_num">({{\App\Models\persianNumber::translate( $countCommentRelated )}})</span>
                                </div>
                                <div class="pr_desc">
                                    <div>{!! Str::limit($proReleted->description, 150, '...') !!}</div>
                                </div>
                                <div class="pr_switch_wrap">
                                    <div class="product_color_switch">
                                        @forelse (\Modules\Product\Color\Models\color::where('product_id',$proReleted->id)->get() as $color)
                                            <span data-color="{{ $color->value }}"></span>
                                        @empty

                                        @endforelse
                                    </div>
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
