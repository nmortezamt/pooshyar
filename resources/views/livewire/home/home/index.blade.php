<div>
    <div>
        <!-- START HEADER -->
        @include('livewire.home.home.header')
        <!-- END HEADER -->
    </div>
    <div>
        <!-- START SECTION BANNER TOP -->
        @include('livewire.home.home.banner_top')
        <!-- END SECTION BANNER TOP-->
    </div>
    <div>
        <!-- START SECTION BANNER -->
        @include('livewire.home.home.banner')
        <!-- END SECTION BANNER -->
    </div>
    <div>
        <!-- START SECTION CATEGORIES -->
        @include('livewire.home.home.categories')
        <!-- END SECTION CATEGORIES -->
    </div>
    <div class="main_content">

        <!-- END SECTION SHOP -->
        <!-- START SECTION BANNER -->
        @php
            $banner_end = \App\Models\EndSeasonDiscount::first() ?? null;
        @endphp
        @if (isset($banner_end) && $banner_end->status == 1)

            <div class="section pb_20 small_pt">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="sale-banner mb-3 mb-md-4">
                                <a class="hover_effect1" href="{{ $banner_end->link }}">
                                    <img src="/uploads/{{ $banner_end->img }}" alt="بنر تخفیف آخر فصل">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- END SECTION BANNER -->

        @include('livewire.home.home.trend-product')
        @php
            $first_article = \Modules\Blog\Models\blog::first();
        @endphp
        @includeIf($first_article,'livewire.home.home.blog')

    </div>
</div>
