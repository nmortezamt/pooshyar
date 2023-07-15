<div>
    @section('title','ویرایش دسترسی')
    <div>
        <div class="main-content padding-0">
            <p class="box__title">ویرایش دسترسی _{{ $permission->title }} </p>
            <div class="row no-gutters bg-white">
                <div class="col-8">
                    <form wire:submit.prevent="permission" class="padding-20">

                        <div class="form-group">
                            <input wire:model.lazy='permission.name' type="text" placeholder="نام انگلیسی دسترسی" class="form-control">
                            @error('permission.name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input wire:model.lazy='permission.description' type="text" placeholder=" توضیح دسترسی " class="form-control">
                            @error('permission.description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-brand style"> ویرایش دسترسی</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
