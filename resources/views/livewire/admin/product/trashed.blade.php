@section('title',' سطل زباله محصولات')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('product.index') }}"> محصولات </a>

            </div>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
               href="{{ route('product.index') }}">
                برگشت

            </a>
        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>آیدی</th>
                            <th>عنوان محصول</th>
                            <th> تصویر محصول</th>
                            <th>دسته های محصول</th>
                            <th>لینک محصول</th>
                            <th>قیمت محصول</th>
                            <th>عملیات</th>

                        </tr>
                        </thead>

                        <tbody>
                        @if ($readyToLoad)
                            @forelse ($products as $product)

                                <tr role="row">
                                <tr role="row">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>
                                        <img src="/uploads/{{ $product->img }}" alt="img" width="50" height="50">
                                    </td>

                                    <td>
                                        _
                                        @foreach (\Modules\Category\Models\category::where('id',$product->category_id)->get() as $cat)
                                            {{ $cat->title }}
                                        @endforeach
                                        <br>
                                        _
                                        @foreach (\App\Models\subcategory::where('id',$product->subcategory_id)->get() as $sub)
                                            {{ $sub->title }}
                                        @endforeach
                                        <br>
                                    </td>
                                    <td>
                                        {{ $product->link }}
                                    </td>
                                    <td>{{ $product->price }}</td>


                                    <td>
                                        <a wire:click='remove({{ $product->id }})' class="item-delete mlg-15"
                                           title="حذف"></a>

                                        <a wire:click='restorecategory({{ $product->id }})'
                                           class="item-li i-checkouts item-restore"> </a>
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
