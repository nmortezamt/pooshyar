<div>
    @section('title',' سطل زباله مقدار مشخصه کالا')

    <div>
        <div class="main-content" wire:init='loadCategory'>

            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="{{ route('attributevalue.trashed') }}">مقدار مشخصه کالا </a>
                </div>
                </a>
                <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
                   href="{{ route('attributevalue.index') }}">
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
                                <th>محصولات</th>
                                <th>مشخصه کالا</th>
                                <th>مقدار</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if ($readyToLoad)
                                @foreach ($attributeValues as $attributeValue)

                                    <tr role="row">
                                        <td>{{ $attributeValue->id }}</td>

                                        <td>
                                            @foreach (\Modules\Product\Product\Models\product::where('id',$attributeValue->product_id)->get() as $product)
                                                {{ $product->title }}
                                            @endforeach

                                        </td>

                                        <td>

                                            @foreach (\App\Models\attribute::where('id',$attributeValue->attribute_id)->get() as $attribute)
                                                {{ $attribute->title }}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $attributeValue->value }}</td>
                                        <td>
                                            <a wire:click='remove({{ $attributeValue->id }})' class="item-delete mlg-15"
                                               title="حذف"></a>

                                            <a wire:click='restorecategory({{ $attributeValue->id }})'
                                               class="item-li i-checkouts item-restore" title="بازیابی"> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $attributeValues->render() }}
                            @else
                                <div class="alert-warning alert">در حال خواندن اطلاعات</div>

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
