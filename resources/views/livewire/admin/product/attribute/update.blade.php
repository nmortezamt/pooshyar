@section('title',' ویرایش مشخصات کالا')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش مشخصات کالا _{{ $attributes->title }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="categoryForm" class="padding-20" enctype="multipart/form-data" role="form">


                    <div class="form-group">
                        <input wire:model.lazy='attribute.title' type="text" placeholder="عنوان مشخصات کالا "
                            class="form-control">
                        @error('attribute.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <select wire:model.lazy='attribute.subcategory_id' class="form-control">
                            <option value="-1">انتخاب زیر دسته نمایش کالا _</option>
                            @foreach (\App\Models\subcategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('attribute.subcategory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='attribute.parent' class="form-control">
                            <option value="-1">انتخاب زیر دسته مشخصات کالا _</option>
                            <option value="0">سر دسته اصلی مشخصات کالا _</option>
                            @foreach (\App\Models\attribute::where('parent',0)->get() as $attribute)
                            <option value="{{ $attribute->id }}">--{{ $attribute->title }}</option>
                            @endforeach
                        </select>
                        @error('attribute.parent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='attribute.position' type="text" placeholder="موقعیت مشخصات کالا "
                            class="form-control">
                        @error('attribute.position')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='attribute.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در دسته اصلی</label>
                        </div>
                    </div>

                    <button class="btn btn-brand style"> ویرایش مشخصات کالا</button>

                </form>
            </div>
        </div>
    </div>

</div>
