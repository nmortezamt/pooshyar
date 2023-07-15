@section('title',' ویرایش عنوان فوتر صفحه سایت')
<div>
    <div class="main-content padding-0">
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="title" class="padding-20">
                    <div class="form-group">
                        <select wire:model.lazy='footer.page_id' name="page_id" class="form-control">
                            <option value="-1">انتخاب صفحه برای فوتر _</option>
                            @foreach (\App\Models\page::all() as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('footer.page_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <button class="btn btn-brand style"> ویرایش عنوان فوتر صفحه سایت</button>
                </form>
            </div>
        </div>
    </div>
</div>
