<div class="col-lg-3 mt-4 pt-2 mt-lg-0 pt-lg-0" wire:ignore>
    <div class="sidebar">
        <div class="widget">
            <button class="btn btn-fill-out mb-4" wire:click='resets'>پاکسازی فیلتر</button>
            <h5 class="widget_title">فیلتر کنید</h5>
            <div class="filter-container">
                <h2>فیلتر بر اساس قیمت</h2>
                <input type="range" min="100000" max="1000000" step="10" value="0" class="range-slider"
                    wire:model='selected.price'>
                <div class="range-values">
                    <span class="min-value">{{ number_format(100000) }} تومان</span>
                    <span class="max-value">{{ number_format(1000000) }} تومان</span>
                </div>
            </div>
        </div>
        @if (Request::routeIs('product.all'))
            <div class="widget">
                <h5 class="widget_title">دسته بندی</h5>
                <ul class="list_brand">
                    @forelse (\App\Models\category::where('status',1)->get() as $category)
                        <li>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                    id="{{ $category->title }}" wire:model="selected.category"
                                    value="{{ $category->id }}">
                                <label class="form-check-label"
                                    for="{{ $category->title }}"><span>{{ $category->title }}</span></label>
                            </div>
                        </li>

                    @empty
                    @endforelse
                </ul>
            </div>
        @endif

        <div class="widget">
            <h5 class="widget_title">سایز</h5>
            <ul class="list_brand">
                @forelse (\App\Models\size::all()->unique('name') as $size)
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="{{ $size->name }}"
                                wire:model="selected.size" value="{{ $size->name }}">
                            <label class="form-check-label"
                                for="{{ $size->name }}"><span>{{ $size->name }}</span></label>
                        </div>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
        <div class="widget">
            <h5 class="widget_title">رنگ</h5>
            <ul class="list_brand">
                @forelse (\App\Models\color::all()->unique('name') as $color)
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="{{ $color->name }}"
                                wire:model="selected.color" value="{{ $color->name }}">
                            <label class="form-check-label" for="{{ $color->name }}">{{ $color->name }}</label>
                        </div>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
        @php
            $banner = \App\Models\specialDiscount::first();
        @endphp
        @if (isset($banner) && $banner->status == 1)
            <div class="widget">
                <div class="shop_banner">
                    <div class="banner_img overlay_bg_20">
                        <img src="/uploads/{{ $banner->img }}" alt="{{ $banner->title }}">
                    </div>
                    <div class="shop_bn_content2 text_white">
                        <h5 class="text-uppercase shop_subtitle">تخفیف ویژه</h5>
                        <h3 class="text-uppercase shop_title">{{ $banner->title }}</h3>
                        <a href="{{ $banner->link }}" class="btn btn-white rounded-0 btn-sm text-uppercase">خرید</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
<script>
    const rangeSlider = document.querySelector('.range-slider');
    let max
    const minSpan = document.querySelector('.min-value');
    const maxSpan = document.querySelector('.max-value');

    rangeSlider.addEventListener('input', (event) => {
        // وقتی مقدار فیلد انتخاب شده تغییر میکند، مقدار جدید را نشان دهید
        minSpan.textContent = rangeSlider.min;
        maxSpan.textContent = event.target.value;

    });
</script>
