@section('title','لوگو سایت')

<div>
    <div class="main-content" wire:init='loadLogo'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('header.index') }}">منو های هدر </a>
                <a class="tab__item"
                    href="{{ route('banner.index') }}">بنر صفحه اصلی</a>

                    <a class="tab__item is-active"
                    href="{{ route('logo.index') }}">لوگو سایت</a>
            </div>
            </a>

        </div>
        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر لوگو</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($logoSite as $logo)
                            <tr role="row">
                                <td>{{ $logo->id }}</td>
                                <td>
                                    <img src="/uploads/{{ $logo->img }}" alt="img" width="300">
                                </td>
                                <td>
                                    <a href="{{ route('logo.update',$logo) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>لوگو ای وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد لوگو</p>
                <form wire:submit.prevent="logo" class="padding-10" enctype="multipart/form-data">

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
                    <button class="btn btn-brand style"> افزودن لوگو</button>
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
