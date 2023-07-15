@section('title',' افزودن مشخصات کالا')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item">مشخصات کالا _</a>
           {{ $this->product->title }}
           <a class="tab__item btn btn-danger text-white" style=" margin-left:10px; float:left;"
           href="{{ route('attributevalue.trashed') }}">سطل زباله
           ({{ \App\Models\attributeValue::onlyTrashed()->count() }})
       </a>
            </div>


        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>مشخصه کالا</th>
                                <th>مقدار </th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @foreach ($attributevalues as $attributeValue)

                            <tr role="row">
                                <td>{{ $attributeValue->id }}</td>

                                <td>

                                    @foreach (\App\Models\attribute::where('id',$attributeValue->attribute_id)->get() as $attribute)
                                    {{ $attribute->title }}
                                    @endforeach
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
                            {{ $attributevalues->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد مقدار مشخصات فنی کالا</p>
                <form wire:submit.prevent="attribute" class="padding-10" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <select wire:model.lazy='attributeValue.attribute_id' class="form-control">
                            <option value="-1">انتخاب مشخصه کالا _</option>
                          @foreach (\App\Models\attribute::where('parent','>', '0')
                            ->where('subcategory_id',$this->product->subcategory_id)
                            ->get() as $attribute)
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
