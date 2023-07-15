<div>
    @section('title',' سبد خرید ها')
<div>
    <div class="main-content" wire:init='loadCart'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('orders.index') }}">سفارشات</a>
                <a class="tab__item is-active" href="{{ route('carts.admin') }}">سبد خریدها</a>
                <a class="tab__item" href="{{ route('payments.index') }}">پرداخت ها</a>
                <a class="tab__item" href="{{ route('payment.paid.index') }}">بانک پرداخت</a>
                <a class="tab__item" href="{{ route('list.favorite.index') }}">علاقه مندی ها</a>
                <a class="tab__item" href="{{ route('invoices.index') }}">صورتحساب</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی سفارش ">
            </div>
            </form>
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>پرداخت</th>
                    <th>محصول</th>
                    <th>نوع خرید</th>
                    <th>کاربر</th>
                    <th>آپی</th>
                    <th>تعداد</th>
                    <th>قیمت محصول</th>
                    <th>رنگ</th>
                    <th>سایز</th>
                    <th>کد تخفیف</th>
                    <th>قیمت کد تخفیف</th>
                    <th>درصد کد تخفیف</th>
                    <th>مجموع قیمت</th>
                    <th>تاریخ ایجاد سفارش</th>
                    <th>عملیات</th>

                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($carts as $cart)
                <tr role="row">
                    <td>{{ $cart->id }}</td>
                    <td>
                        @if ($cart->status == 1)
                        <div class="alert-sm alert-success">پرداخت شده</div>
                        @else
                        <div class="alert-sm alert-danger">پرداخت نشده</div>
                        @endif
                    </td>
                    <td>{{ $cart->product->title }}</td>
                    <td>{{ $cart->type == 'single' ? 'تکی' : 'عمده' }}</td>
                    <td>
                        @if (isset($cart->user->name))
                        {{ $cart->user->name .'='.$cart->user->id}}
                        @elseif (isset($cart->user->id))
                        {{ $cart->user->id}}
                        @else
                        'ناشناس'
                        @endif
                    </td>
                    <td>{{ $cart->ip }}</td>
                    <td>{{ $cart->count}}</td>
                    <td>{{ $cart->product_price}}</td>
                    <td>
                        @php
                            $color_name = json_decode($cart->color_id,true);
                        @endphp
                            @foreach(array_keys($color_name) as $name)
                                @if($loop->last)
                                    <span>{{ $name }}</span>
                                @else
                                    <span>{{ $name }} ,</span>
                                @endif
                            @endforeach
                    </td>
                    <td>
                        @php
                            $size_name = json_decode($cart->size_id,true);
                            @endphp
                            @foreach(array_keys($size_name) as $name)
                            @if($loop->last)
                            <span>{{ $name }}</span>
                            @else
                            <span>{{ $name }} ,</span>
                            @endif
                            @endforeach
                    </td>
                    <td>{{ $cart->discount_code ?? 'ندارد'}}</td>
                    <td>{{ $cart->discount_price ?? 'ندارد'}}</td>
                    <td>{{ $cart->discount_percent ?? 'ندارد'}}</td>
                    <td>{{ $cart->total_price}}</td>
                    <td>{{ jdate($cart->created_at)->format('%Y/%m/%d') }}</td>
                    <td>
                        <button wire:click='remove({{ $cart->id }})' href="" class="item-delete mlg-15"
                            title="حذف"></button>

                            <a href="{{ route('cart.view',$cart->id) }}" class="item-eye"
                            title="نمایش"> </a>
                    </td>
                </tr>
                @empty
                <div>سفارشی وجود ندارد</div>
                @endforelse
                {{ $carts->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
