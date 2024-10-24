@section('title','رنگ ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('product.index') }}"> محصولات </a>
                <a class="tab__item" href="{{ route('gallery.index') }}"> گالری تصاویر محصولات </a>
                <a class="tab__item is-active" href="{{ route('color.index') }}"> رنگ محصولات </a>
                <a class="tab__item" href="{{ route('size.index') }}"> سایز محصولات </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form action="" onclick="event.preventDefault();">
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی رنگ ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
               href="{{ route('color.trashed') }}"
            >سطل زباله
                ({{ \Modules\Product\Color\Models\color::onlyTrashed()->count() }})
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>آیدی</th>
                            <th>نام رنگ</th>
                            <th>کد رنگ</th>
                            <th>محصول</th>
                            <th>عملیات</th>

                        </tr>
                        </thead>

                        <tbody>
                        @if ($readyToLoad)


                            @forelse ($colors as $color)

                                <tr role="row">
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td><a style="background-color: {{ $color->value }}">{{ $color->value }}</a></td>
                                    <td>{{ $color->product->title }}</td>
                                    <td>
                                        <button wire:click='remove({{ $color->id }})' class="item-delete mlg-15"
                                                title="حذف"></button>

                                        <a href="{{ route('color.update',$color) }}" class="item-edit "
                                           title="ویرایش"></a>
                                    </td>
                                </tr>
                            @empty
                                <div>رنگی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $colors->render() }}
                        @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد رنگ جدید</p>
                <form wire:submit.prevent="color" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='color.name' type="text" placeholder="نام  رنگ "
                               class="form-control">
                        @error('color.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input data-jscolor="" wire:model.lazy='color.value' type="text" placeholder=" کد رنگ "
                               class="form-control">
                        @error('color.value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='color.product_id' class="form-control">
                            <option value="1"> _محصول</option>
                            @foreach (\Modules\Product\Product\Models\product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('color.product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style"> افزودن رنگ</button>

                </form>

            </div>
        </div>
    </div>
</div>
