<div>
    @section('profile','علاقه مندی ها | پروفایل - پوشیار')
    <div class="tab-pane" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h3>علاقه مندی ها</h3>
        </div>

        @if (\App\Models\favorite::where('user_id',auth()->user()->id)->first())

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>محصول</th>
                            <th>قیمت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($favorites as $favorite)
                        <tr wire:key="{{ $favorite->id }}">
                            <td>{{ $favorite->product->title }}</td>
                            <td>
                            @if ($favorite->product->discount_price)
                            <span class="price">{{
                                \App\Models\persianNumber::translate(number_format($favorite->product->price/100*(100-$favorite->product->discount_price)) )}}
                                تومان</span>
                            <del>{{ \App\Models\persianNumber::translate(number_format($favorite->product->price) )}} تومان</del>
                            <div class="on_sale">
                                <span>{{\App\Models\persianNumber::translate( $favorite->product->discount_price )}}% تخفیف</span>
                            </div>
                            @else
                            {{ \App\Models\persianNumber::translate(number_format($favorite->product->price)) }} تومان
                            @endif
                            </td>

                            <td>{{ \App\Models\persianNumber::translate(jdate($favorite->created_at)->format('%d  %B %Y') )}}</td>

                            <td><a href="{{ route('product.single.index',['id'=>$favorite->product->id , 'link'=>$favorite->product->link]) }}" class="btn btn-fill-out btn-sm" target="_blank">مشاهده</a>

                            <a wire:click='removeFavorite({{ $favorite->id }})' class="ml-3">
                                <div wire:loading wire:target="removeFavorite({{ $favorite->id }})">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                                <span wire:loading.remove wire:target="removeFavorite({{ $favorite->id }})">
                                    <i class="ti-close"></i>
                                </span>
                            </a>
                        </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        @else
        <h3 class="text-center">لیست علاقه مندی شما خالی است</h3>
        @endif

    </div>
  </div>

</div>
