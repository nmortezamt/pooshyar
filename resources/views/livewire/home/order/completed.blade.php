<div>

     <!-- START HEADER -->
     @include('livewire.home.home.header')
     <!-- END HEADER -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="text-center order_complete">
                            <i class="fas fa-check-circle"></i>
                            <div class="heading_s1">
                              <h3>سفارش شما تکمیل شد!</h3>
                            </div>
                              <p>از سفارش شما متشکریم! سفارش شما در حال پردازش است و ظرف 3 تا 6 ساعت تکمیل خواهد شد. پس از تکمیل سفارش شما یک ایمیل تاییدیه دریافت خواهید کرد.
                            </p>
                            <a href="{{ route('profile.orders') }}" class="btn btn-fill-out">مشاهد سفارش</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->
        </div>
</div>
