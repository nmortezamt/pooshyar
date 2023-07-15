@section('title','صفحات سایت')

<div>
    <div class="main-content" wire:init='loadPage'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('page.index') }}">صفحات سایت </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی صفحه سایت  ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('page.trashed') }}"
            >سطل زباله
            ({{ \App\Models\page::onlyTrashed()->count() }})
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر صفحه سایت</th>
                                <th>عنوان صفحه سایت</th>
                                <th>لینک صفحه سایت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($pages as $page)
                            <tr role="row">
                                <td>{{ $page->id }}</td>
                                <td>
                                    @if($page->img)
                                    <img src="/uploads/{{ $page->img }}" alt="img" width="50" height="50">
                                    @else
                                    <p>تصویر ندارد</p>
                                    @endif

                                </td>
                                <td>{{ $page->title }}</td>
                                <td><a href="{{ url($page->link) }}" target ='_blank'>{{ $page->link }}</a></td>

                                <td>
                                    <button wire:click='remove({{ $page->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('page.update',$page) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>صفحه ای وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $pages->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد صفحه سایت  جدید</p>
                <form wire:submit.prevent="page" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='page_site.title' type="text" placeholder="عنوان صفحه سایت  "
                            class="form-control" name="name">
                        @error('page.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='page_site.link' type="text" placeholder=" لینک صفحه سایت" class="form-control" name="link">
                        @error('page_site.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                    <button class="btn btn-brand style"> افزودن صفحه سایت </button>
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
