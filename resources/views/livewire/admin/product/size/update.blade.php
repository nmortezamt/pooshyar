@section('title',' ویرایش سایز ')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش سایز  _{{ $size->name }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="size" class="padding-20" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <input wire:model.lazy='size.name' type="text" placeholder="نام  سایز "
                            class="form-control">
                            @error('size.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='size.product_id' class="form-control">
                            <option value="-1" disabled> _محصول</option>
                            @foreach (\App\Models\product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('size.product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style">ویرایش  سایز</button>
                </form>
            </div>
        </div>
    </div>

</div>
