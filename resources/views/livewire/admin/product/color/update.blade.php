@section('title',' ویرایش رنگ ')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش رنگ _{{ $colors->name }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="color" class="padding-20" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <input wire:model.lazy='color.name' type="text" placeholder="نام  رنگ "
                               class="form-control">
                        @error('color.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input data-jscolor="" wire:model.lazy='color.value' type="text" placeholder="کد رنگ"
                               class="form-control">
                        @error('color.value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='color.product_id' class="form-control">
                            <option value="-1" disabled> _محصول</option>
                            @foreach (\Modules\Product\Product\Models\product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('color.product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button class="btn btn-brand style">ویرایش رنگ</button>

                </form>
            </div>
        </div>
    </div>

</div>
