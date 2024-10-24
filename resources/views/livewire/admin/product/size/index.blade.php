@section('title','سایز ها')

<div>
    <div class="main-content" wire:init='loadSize'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('product.index') }}"> محصولات </a>
                <a class="tab__item" href="{{ route('gallery.index') }}"> گالری تصاویر محصولات </a>
                <a class="tab__item" href="{{ route('color.index') }}"> رنگ محصولات </a>

                <a class="tab__item is-active" href="{{ route('size.index') }}"> سایز محصولات </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form action="" onclick="event.preventDefault();">
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی سایز ">
            </div>
            </form>
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>آیدی</th>
                            <th>نام سایز</th>
                            <th>محصول</th>
                            <th>عملیات</th>

                        </tr>
                        </thead>

                        <tbody>
                        @if ($readyToLoad)
                            @forelse ($sizes as $size)
                                <tr role="row">
                                    <td>{{ $size->id }}</td>
                                    <td>{{ $size->name }}</td>
                                    <td>{{ $size->product->title }}</td>
                                    <td>
                                        <button wire:click='remove({{ $size->id }})' class="item-delete mlg-15"
                                                title="حذف"></button>

                                        <a href="{{ route('size.update',$size) }}" class="item-edit "
                                           title="ویرایش"></a>
                                    </td>
                                </tr>
                            @empty
                                <div>رنگی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $sizes->render() }}
                        @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد سایز جدید</p>
                <form wire:submit.prevent="size" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='size.name' type="text" placeholder="نام  سایز "
                               class="form-control">
                        @error('size.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='size.product_id' class="form-control">
                            <option value="1"> _محصول</option>
                            @foreach (\Modules\Product\Product\Models\product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('size.product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style"> افزودن سایز</button>

                </form>

            </div>
        </div>
    </div>
</div>
