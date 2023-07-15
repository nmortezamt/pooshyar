        <!-- START SECTION BANNER -->
        <div class="section pb_20 small_pt">
            <div class="container">
                <div class="row">
                    @forelse (\App\Models\newTask::where('status',1)->get() as $banner)
                    <div wire:key="{{ $banner->id }}" class="col-md-4">
                        <div class="sale-banner mb-3 mb-md-4">
                            <a class="hover_effect1" href="/{{ $banner->link }}">
                                <img src="/uploads/{{ $banner->img }}" alt="shop_banner_img" class="resize_image">
                            </a>
                        </div>
                    </div>
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
        <!-- END SECTION BANNER -->
