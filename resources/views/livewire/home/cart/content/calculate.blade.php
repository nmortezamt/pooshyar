<div class="row">
    <div class="col-md-6">
        <div class="border p-3 p-md-4">
            <div class="heading_s1 mb-3">
                <h6>مجموع سبد خرید</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    @if (auth()->user())
                        <tbody>
                            <tr>
                                <td class="cart_total_label">تخفیف محصولات</td>
                                <td class="cart_total_amount">
                                    @php
                                        $total_price_product = 0;
                                        $total_discount = 0;
                                        foreach ($carts as $cart) {
                                            if (!empty($cart->product_price_discount)) {
                                                $total_discount += $cart->product_price_discount * $cart->count;
                                                $total_price_product += $cart->product_price * $cart->count;
                                            }
                                        }
                                    @endphp

                                    @if (!empty($total_discount))
                                        @php
                                            $res = $total_price_product - $total_discount;
                                            echo \App\Models\persianNumber::translate(number_format($res)) . ' تومان';
                                        @endphp
                                    @else
                                        بدون تخفیف
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">مجموع</td>
                                <td class="cart_total_amount">
                                    <strong>{{ \App\Models\persianNumber::translate(number_format($carts->sum('total_price'))) }}
                                        تومان</strong></td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td class="cart_total_label">تخفیف محصولات</td>
                                <td class="cart_total_amount">
                                    @php
                                        $total_price = 0;
                                        $total_price_product = 0;
                                        $total_discount = 0;
                                        foreach ($carts as $cart) {
                                            if (!empty($cart['product_price_discount'])) {
                                                $total_discount += $cart['product_price_discount'] * $cart['count'];
                                                $total_price_product += $cart['product_price'] * $cart['count'];
                                            }
                                            $total_price += $cart['total_price'];
                                        }
                                    @endphp

                                    @if (!empty($total_discount))
                                        @php
                                            $res = $total_price_product - $total_discount;
                                            echo \App\Models\persianNumber::translate(number_format($res)) . ' تومان';

                                        @endphp
                                    @else
                                        بدون تخفیف
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">مجموع</td>
                                <td class="cart_total_amount">
                                    <strong>{{ \App\Models\persianNumber::translate(number_format($total_price)) }}
                                        تومان</strong></td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <a wire:click='orderForm' class="btn btn-fill-out text-white">برای تسویه حساب ادامه دهید <div wire:loading
                    wire:target="orderForm">
                    <i class="fas fa-spinner fa-spin font-search"></i>
                </div></a>
        </div>
    </div>
</div>
