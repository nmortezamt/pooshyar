<div>
        <!-- START HEADER -->
        @include('livewire.home.home.header')
        <!-- END HEADER -->
    <!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                {{-- @if (! auth()->user())
                <div class="col-lg-6" >
                    <div class="toggle_info">
                        <span><i class="fas fa-user"></i>برای پرداخت وارد شوید! <a href="#loginform" data-toggle="collapse" class="collapsed" aria-expanded="false">برای ورود اینجا کلیک کنید</a></span>
                    </div>
                    <div class="panel-collapse collapse login_form" id="loginform">
                        <div class="panel-body">
                            <p>اگر قبلا از ما خرید کرده اید، لطفا مشخصات خود را در زیر وارد کنید. اگر مشتری جدید هستید، لطفاً به صورت‌حساب ادامه دهید
                            </p>
                            <form wire:submit.prevent='loginForm'>
                                <div class="form-group">
                                    <input type="email" required class="form-control" name="email" placeholder="ایمیل" wire:model.defer='emailLogin'>
                                    @error('emailLogin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required type="password" name="password" placeholder="رمز عبور" wire:model.defer='passwordLogin'>
                                    @error('passwordLogin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                            <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                        </div>
                                    </div>
                                    <a href="#">Forgot password?</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="login">Log in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif --}}
                @if ($this->discount_code == null)

                <div class="col-lg-6" wire:ignore>
                    <div class="toggle_info">
                        <span><i class="fas fa-tag"></i>کد تخفیف دارید؟<a href="#coupon" data-toggle="collapse" class="collapsed" aria-expanded="false">برای وارد کردن کد خود اینجا را کلیک کنید
                        </a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form" id="coupon">
                        <div class="panel-body">
                            <p>اگر کد تخفیف دارید، لطفاً آن را در زیر اعمال کنید.</p>
                            <form wire:submit.prevent='discountForm'>
                            <div class="coupon field_form input-group">
                                <input type="text" wire:model.lazy='code' class="form-control" placeholder="کد تخفیف را وارد کنید.." name="code" required>

                                <div class="input-group-append">
                                    <button class="btn btn-fill-out btn-sm" type="submit">درخواست تخفیف <div wire:loading wire:target="discountForm">
                                        <i class="fas fa-spinner fa-spin font-search"></i>
                                    </div>
                                </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1">
                        <h4>جزئیات صورتحساب</h4>
                    </div>
                    <form>
                        <div class="form-group">
                            <input type="text" required="" class="form-control" name="name" placeholder="نام *" wire:model.lazy='payment.name'>
                            @error('payment.name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" required="" class="form-control" name="family" placeholder="نام خانوادگی *" wire:model.lazy='payment.lname'>
                            @error('payment.lname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="" type="text" name="state" placeholder="استان *" wire:model.lazy='payment.state'>
                            @error('payment.state')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control" required="" type="text" name="city" placeholder="شهر *" wire:model.lazy='payment.city'>
                            @error('payment.city')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="billing_address" required="" placeholder="آدرس *" wire:model.lazy='payment.address'>
                            @error('payment.address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="billing_address2" required="" placeholder="خط 2 آدرس" wire:model.lazy='payment.address2'>
                            @error('payment.address2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control" required="" type="text" name="zipcode" placeholder="کدپستی* (بدون علامت -)" wire:model.lazy='payment.postal_code'>
                            @error('payment.postal_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="" type="text" name="phone" placeholder="تلفن *" wire:model.lazy='payment.phone'>
                            @error('payment.phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control" required="" type="text" name="email" placeholder="آدرس ایمیل *" wire:model.lazy='payment.email'>
                            @error('payment.email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- @if (! auth()->user())

                        <div class="form-group">
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount" wire:model='account' value="on">

                                    <label class="form-check-label label_info" for="createaccount"><span>ایجاد حساب کاربری؟</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group create-account" wire:ignore>
                            <input class="form-control" required="" type="password" placeholder="رمز عبور" name="password" wire:model.lazy='password2'>
                        </div>
                        @error('password2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif --}}


                        <div class="heading_s1">
                            <h4>اطلاعات تکمیلی</h4>
                        </div>
                        <div class="form-group mb-0">
                            <textarea rows="5" class="form-control" placeholder="سفارش یادداشت
                            " wire:model.lazy='payment.info'></textarea>
                        </div>

                    </form>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>سفارشات شما</h4>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>محصول</th>
                                        <th>مجموع</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->product->title }} {{ \App\Models\persianNumber::translate($order->count) }}x </td>
                                        <td>{{ \App\Models\persianNumber::translate(number_format($order->price)) }} تومان</td>
                                    </tr>
                                    @empty

                                    @endforelse


                                </tbody>
                                <tfoot>
                                    @if ($this->discount_price != null)
                                    <tr class="alert-info">
                                        <th>کد تخفیف</th>
                                        <td>
                                            {{ \App\Models\persianNumber::translate(number_format($this->discount_code->price))}} تومان
                                        </td>
                                    </tr>
                                    @elseif ($this->discount_percent != null)
                                    <tr class="alert-info">
                                        <th>کد تخفیف</th>
                                        <td>
                                            {{ \App\Models\persianNumber::translate($this->discount_code->percent) }}%
                                        </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <th>مجموع</th>
                                        <td class="product-subtotal">
                                            @if ($this->discount_price !=null)
                                            {{\App\Models\persianNumber::translate( number_format($this->discount_price)) }} تومان
                                            @elseif ($this->discount_percent != null)
                                            {{\App\Models\persianNumber::translate( number_format($this->discount_percent) )}} تومان
                                            @else
                                            {{ \App\Models\persianNumber::translate(number_format($orders->sum('price')) )}}تومان
                                            @endif
                                            </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <a class="btn btn-fill-out btn-block text-white" wire:click='payment({{ $order_count }})'>ثبت سفارش و پرداخت <div wire:loading wire:target="payment({{ $order_count }})">
                            <i class="fas fa-spinner fa-spin font-search"></i>
                        </div></a>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
