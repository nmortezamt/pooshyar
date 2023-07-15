<div>
    <div class="main_content">
        <style>
    #timer {
	text-align: center
}

#resend {
	display: block;
	margin: 20px auto 0;
	padding: 10px 30px;
	background-color: #0078e7;
	border: none;
	color: #fff;
	font-size: 20px;
	border-radius: 5px;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
	cursor: pointer;
}

#resend:disabled {
	background-color: #ccc;
	cursor: not-allowed;
}
        </style>
        <!-- START LOGIN SECTION -->
        <div class="login_register_wrap section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-10">
                        <div class="login_wrap">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3>کد تایید را وارد کنید</h3>
                                </div>
                                <form wire:submit.prevent='login'>
                                    <div class="form-group">
                                        <label for="phone">کد تایید برای شماره {{\App\Models\persianNumber::translate($phone->user->number)  }} پیامک شد
                                        </label>
                                        <input class="form-control text-center" type="text" name="code" wire:model.lazy='code' maxlength="5" autofocus>
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block" name="login" id="submit-btn"> تایید <span wire:loading wire:target="login">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span></button>
                                    </div>
                                    <div id="timer" wire:ignore></div>
                                <button id="resend" disabled wire:click='resendCode({{ $phone->user->id }})'>دریافت مجدد کد تایید</button>
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
            const timer = document.getElementById('timer');
            const resend = document.getElementById('resend');
            let timeLeft = 180;

            function countdown() {
                if (timeLeft == 0) {
                    clearInterval(countdownTimer);
                    resend.removeAttribute('disabled');
                    timer.innerHTML = '';
                } else {
                    timer.innerHTML = ' ارسال مجدد کد تا ' + formatTime(timeLeft)+' دیگر';
                    timeLeft--;
                }
            }

            function formatTime(time) {
                let minutes = Math.floor(time / 60);
                let seconds = time % 60;
                if (seconds < 10) {
                    seconds = '0' + seconds;
                }
                return minutes + ':' + seconds;
            }

            const countdownTimer = setInterval(countdown, 1000);

            resend.addEventListener('click', function() {
                timeLeft = 180;
                resend.setAttribute('disabled', true);
                countdownTimer = setInterval(countdown, 1000);
            });
        </script>
</div>
{{-- <script>
    var timeleft = 180; // in second
    var timer = setInterval(function(){
        document.getElementById("timer").textContent = timeleft + " seconds remaining."; // displays the timer on the screen
        timeleft -= 1;
        if(timeleft <= 0){
            clearInterval(timer);
            document.getElementById("resend-btn").disabled = false; // re-enables the resend button
            document.getElementById("timer").textContent = "Time's up. You can try again now.";
        }
    }, 1000);

    function resendSMS(){
        document.getElementById("resend-btn").disabled = true; // disables the resend button after it is clicked
        timeleft = 180; // resets the timer when the button is clicked
        timer = setInterval(function(){
            document.getElementById("timer").textContent = timeleft + " seconds remaining.";
            timeleft -= 1;
            if(timeleft <= 0){
                clearInterval(timer);
                document.getElementById("resend-btn").disabled = false;
                document.getElementById("timer").textContent = "Time's up. You can try again now.";
            }
        }, 1000);
    }
</script> --}}
