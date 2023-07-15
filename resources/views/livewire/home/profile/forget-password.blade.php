<div>
    @section('profile','بازیابی رمز عبور - پوشیار')
    <div class="main_content">

        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3>تغییر رمز عبور</h3>
                                </div>
                                <form wire:submit.prevent='updatePassword'>
                                    <div class="form-group">
                                        <label for="phone">برای تغییر رمز عبور، شماره موبایل خود را وارد کنید
                                        </label>
                                        <input class="form-control" type="tel" name="phone" placeholder="شماره تلفن" wire:model.lazy='phone' autofocus>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block" name="login" >تایید</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LOGIN SECTION -->

        </div>
</div>
