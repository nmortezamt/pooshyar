<div class="section small_pb small_pt" wire:ignore>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>جدیدترین دسته بندی ها</h2>
                </div>
                <p class="text-center leads">مشتری بسیار مهم است، مشتری توسط مشتری دنبال خواهد شد. قایق مردم را متملق می
                    کند، زیرا اکنون کازینو وجود ندارد.</p>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <div class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5"
                     data-loop="true" data-dots="false" data-nav="true" data-margin="30"
                     data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}}'>
                    @forelse (\Modules\Category\Models\category::where('status',1)->latest()->take(5)->get() as $category)
                        <div wire:key="{{ $category->id }}" class="item">
                            <div class="categories_box">
                                <a href="{{ route('product.category.index', $category->link )}}">
                                    <img src="/uploads/{{ $category->img }}" alt="{{ $category->title }}"
                                         class="resize_image">
                                    <span>{{ $category->title }}</span>
                                </a>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
