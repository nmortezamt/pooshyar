@section('title',' محصولات')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('product.index') }}"> محصولات </a>
                <a class="tab__item" href="{{ route('gallery.index') }}"> گالری تصاویر محصولات </a>
                <a class="tab__item " href="{{ route('color.index') }}"> رنگ محصولات </a>
                <a class="tab__item" href="{{ route('size.index') }}"> سایز محصولات </a>

                <br>
                <a class="tab__item">جستجو:</a>
                <a class="t-header-search">
                <form>
                    <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی محصول ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
                href="{{ route('product.trashed') }}">سطل زباله
                ({{ \App\Models\product::onlyTrashed()->count() }})
            </a>

            <a class="tab__item btn btn-success text-white" style="margin-top:-60px; margin-left:120px; float:left;"
                href="{{ route('product.create') }}">
                افزودن محصول
            </a>

        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر محصول</th>
                                <th>عنوان محصول </th>
                                <th>لینک محصول </th>
                                <th>دسته های محصول</th>
                                <th>مشخصات کالا</th>
                                <th> گالری تصاویر محصول</th>
                                <th> رنگ محصول</th>
                                <th> سایز محصول</th>
                                <th> زمان ارسال</th>
                                <th>قیمت محصول</th>
                                <th>تعداد بازدید</th>
                                <th>وضعیت محصول</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($products as $product)

                            <tr role="row">
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="/uploads/{{ $product->img }}" alt="img" width="50" height="50">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->link }}</td>
                                <td>
                                    __دسته:
                                    {{ $product->category->title }}
                                    <br>
                                    __زیر دسته:
                                    {{ $product->subcategory->title }}
                                    <br>
                                    __برند:
                                   {{$product->brand->name ?? 'ندارد'}}

                                </td>
                                <td>
                                    <a href="{{ route('attribute.product',$product) }}" title="مشخصات فنی"
                                        style="margin-right:10px"><img src="{{ asset('icon/icons/list-check.svg') }}"
                                            width='20' style="margin-top: -5px;"></a>

                                </td>
                                <td>
                                    <a href="{{ route('gallery.product_image',$product) }}" title="گالری تصاویر محصولات"
                                        style="margin-right:10px"><img src="{{ asset('icon/icons/images.svg') }}"
                                            width='20' style="margin-top: -5px;"></a>
                                </td>

                                <td>
                                    <a href="{{ route('color.product_color',$product) }}" title=" رنگ محصول"
                                        style="margin-right:10px">
                                        <img src="{{ asset('icon/icons/paint-bucket.svg') }}" width="20"
                                            style="margin-top: -5px;">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('size.product_size',$product) }}" title=" سایز محصول"
                                        style="margin-right:10px">
                                        <img src="{{ asset('icon/icons/textarea-resize.svg') }}" width="20"
                                            style="margin-top: -5px;">
                                    </a>
                                </td>

                                <td>{{ $product->time }}روز</td>

                                <td>قیمت:{{ number_format($product->price) }}
                                @if ($product->discount_price)
                                <br>
                                درصد تخفیف
                                {{ '%'.$product->discount_price}}
                                <br>
                                قیمت تخفیف خورده:
                                {{ number_format($product->price/100*(100-$product->discount_price)) }}
                                @else
                                <p>قیمت تخفیف خورده:ندارد
                                </p>
                                
                                @endif
                                <p>قیمت عمده:{{ number_format($product->price_major) }}</p>
                                </td>
                                <td>{{ $product->view }}</td>
                                <td>
                                    @if ($product->status==1)
                                    <button wire:click="updateCategorydisable({{ $product->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $product->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $product->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('product.update',$product) }}" class="item-edit "
                                        title="ویرایش"></a>


                                </td>
                            </tr>
                            @empty
                            <div>محصولی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $products->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
