@section('title',' ویرایش عنوان فوتر سایت')
<div>
    <div class="main-content padding-0">
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="title" class="padding-20">

                    <div class="form-group">
                        <textarea wire:model.lazy='footerTitle.title' type="text"
                            class="form-control">
                        @error('footerTitle.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </textarea>

                    <button class="btn btn-brand style"> ویرایش عنوان فوتر صفحه سایت</button>

                </form>
            </div>
        </div>
    </div>
</div>
