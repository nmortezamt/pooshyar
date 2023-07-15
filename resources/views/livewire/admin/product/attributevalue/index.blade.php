@section('title','  مقدار مشخصات کالا')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('attribute.index') }}">مشخصات کالا </a>
                <a class="tab__item is-active" href="{{ route('attributevalue.index') }}"> مقدار مشخصات کالا </a>


                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی دسته ">
            </div>
            </form>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('attributevalue.trashed') }}"
            >سطل زباله
            ({{ \App\Models\attributeValue::onlyTrashed()->count() }})
            </a>
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>محصولات</th>
                                <th>مشخصه کالا</th>
                                <th>مقدار </th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @foreach ($attributeValues as $attributeValue)

                            <tr role="row">
                                <td>{{ $attributeValue->id }}</td>

                                <td>
                                   {{$attributeValue->product->title}}
                                </td>

                                <td>
                                    {{ $attributeValue->attribute->title }}
                            </td>
                            <td>
                                {{ $attributeValue->value }}</td>
                                <td>
                                    @if ($attributeValue->status==1)
                                    <button wire:click="updateCategorydisable({{ $attributeValue->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $attributeValue->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $attributeValue->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('attributevalue.update',$attributeValue) }}"
                                    class="item-edit"
                                    title="ویرایش"></a>
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

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد مشخصات فنی کالا</p>
                <form wire:submit.prevent="attribute_value" class="padding-10" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <select wire:model.lazy='attributeValue.product_id' name="" id="" class="form-control">
                            <option value="-1">انتخاب محصول _</option>
                            @foreach (\App\Models\product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('attributeValue.product_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='attributeValue.attribute_id' class="form-control">
                            <option value="-1">انتخاب زیر دسته مشخصات کالا _</option>
                            @foreach (\App\Models\attribute::where('parent' , '>', 0)->get() as $attribute)
                            <option value="{{ $attribute->id }}">--{{ $attribute->title }}</option>
                            @endforeach
                        </select>
                        @error('attributeValue.attribute_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='attributeValue.value' type="text" placeholder="مقدار مشخصات کالا "
                            class="form-control">
                        @error('attributeValue.value')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='attributeValue.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در مقدار مشخصات کالا</label>
                        </div>
                    </div>


                    <button class="btn btn-brand style"> افزودن مشخصات کالا</button>

                </form>

            </div>

        </div>

    </div>

</div>

