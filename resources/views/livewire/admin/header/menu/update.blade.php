@section('title','ویرایش منو سایت')

<div>
    <div class="main-content">

        <div class="row">

            <div class="col-12 bg-white">
                <p class="box__title">ویرایش منو {{ $menu->title }}</p>
                <form wire:submit.prevent="menu" class="padding-10">

                    <div class="form-group">
                        <input wire:model.lazy='menu.title' type="text" placeholder="نام منو " class="form-control">
                        @error('menu.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='menu.link' type="text" placeholder=" لینک منو " class="form-control">
                        @error('menu.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style">ویرایش منو</button>
                </form>
            </div>
        </div>
    </div>
</div>
