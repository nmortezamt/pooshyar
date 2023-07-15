@section('title','بنر صفحه اصلی')

<div>
    <div class="main-content" wire:init='loadBanner'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('header.index') }}">منو های هدر </a>
                <a class="tab__item is-active"
                    href="{{ route('banner.index') }}">بنر صفحه اصلی</a>

                    <a class="tab__item"
                    href="{{ route('logo.index') }}">لوگو سایت</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی بنر ">
            </div>
            </form>
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر بنر</th>
                                <th>عنوان بنر</th>
                                <th>توضیح بنر</th>
                                <th> لینک بنر</th>
                                <th>وضعیت بنر</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($banners as $banner)
                            <tr role="row">
                                <td>{{ $banner->id }}</td>
                                <td>
                                    @if ($banner->img)
                                    <img src="/uploads/{{ $banner->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->description }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>
                                    @if ($banner->status==1)
                                    <button wire:click="updateCategorydisable({{ $banner->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $banner->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('banner.update',$banner) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>بنری وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        {{ $banners->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد بنر جدید</p>
                <form wire:submit.prevent="banner" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='banner.title' type="text" placeholder="عنوان بنر " class="form-control">
                        @error('banner.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='banner.description' type="text" placeholder="توضیح کوتاه بنر " class="form-control">
                        @error('banner.description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='banner.link' type="text" placeholder="لینک بنر " class="form-control">
                        @error('banner.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model.lazy='banner.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در بنر اصلی</label>
                        </div>
                    </div>


                    <div>
                        <input type="file" class="form-control" wire:model='image'>
                        <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                        <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                            <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        @if($image)
                        <img src="{{ $image->temporaryUrl()}}" width="350" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-brand style"> افزودن دسته</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load' ,()=>{
           let progressSection = document.querySelector('#progressbar'),
           progressBar =progressSection.querySelector('.progress-bar');
           document.addEventListener('livewire-upload-start',()=>{
               console.log('شروع دانلود');
               progressSection.style.display = 'flex';
           });
           document.addEventListener('livewire-upload-finish',()=>{
               console.log('اتمام دانلود');
               progressSection.style.display = 'none';
           });
           document.addEventListener('livewire-upload-error	',()=>{
               console.log(' اررور موقع دانلود');
               progressSection.style.display = 'none';
           });
           document.addEventListener('livewire-upload-progress',(event)=>{
               console.log(`${event.detail.progress}%`);
               progressBar.style.width = `${event.detail.progress}%`;
               progressBar.textContent = `${event.detail.progress}%`;

           });
       });
    </script>
</div>
