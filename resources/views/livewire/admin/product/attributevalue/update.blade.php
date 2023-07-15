@section('title',' ویرایش مقدار مشخصه کالا')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش مقدار مشخصه کالا _{{ $attributeValue->value }} </p>
        <div class="col-8 bg-white">
            <p class="box__title">ایجاد مشخصات فنی کالا</p>
            <form wire:submit.prevent="attribute_value" class="padding-20" enctype="multipart/form-data" role="form">

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
                        @foreach ($att as $attribute)
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


                <button class="btn btn-brand style"> ویرایش مشخصات کالا</button>

            </form>

        </div>
    </div>

</div>
