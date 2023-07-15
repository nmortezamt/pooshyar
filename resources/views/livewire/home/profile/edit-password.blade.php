<div>
    @section('profile','تغییر رمز عبور - پوشیار')
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
                                <form wire:submit.prevent='editPassword'>
                                    <div class="form-group">
                                        <button type="button" id="show-password"><i class="far fa-eye"></i></button>
                                        <label for="phone">رمز عبور جدید
                                        </label>
                                        <input class="form-control" type="password" name="password" wire:model.lazy='newpass' id="password-input" autofocus>

                                        @error('newpass')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <ul>
                                    <li>حداقل 8 حرف</li>
                                  </ul>
                                  <br>
                                    <div class="form-group">
                                        <button type="button" id="show-password2"><i class="far fa-eye"></i></button>
                                        <label for="phone">تکرار رمز عبور جدید
                                        </label>
                                        <input class="form-control" type="password" name="password" wire:model.lazy='newrepass' id="password-input2">
                                        @error('newrepass')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block" name="login" id="submit-btn">تغییر رمز عبور</button>
                                    </div>
                                    <div id="timer" wire:ignore></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END LOGIN SECTION -->

        </div>
<script>
    const passwordInput = document.getElementById('password-input');
    const showPasswordButton = document.getElementById('show-password');

    showPasswordButton.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    showPasswordButton.innerHTML = '<i class="far fa-eye-slash"></i>';
    showPasswordButton.classList.add('hide-password');
    } else {
    passwordInput.type = 'password';
    showPasswordButton.innerHTML = '<i class="far fa-eye"></i>';
    showPasswordButton.classList.remove('hide-password');
    }
    });
</script>

<script>
    const passwordInput2 = document.getElementById('password-input2');
    const showPasswordButton2 = document.getElementById('show-password2');

    showPasswordButton2.addEventListener('click', function() {
    if (passwordInput2.type === 'password') {
    passwordInput2.type = 'text';
    showPasswordButton2.innerHTML = '<i class="far fa-eye-slash"></i>';
    showPasswordButton2.classList.add('hide-password');
    } else {
    passwordInput2.type = 'password';
    showPasswordButton2.innerHTML = '<i class="far fa-eye"></i>';
    showPasswordButton2.classList.remove('hide-password');
    }
    });
</script>
</div>





