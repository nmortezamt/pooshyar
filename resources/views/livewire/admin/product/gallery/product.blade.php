@section('title','گالری تصاویر محصولات ')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item"> گالری تصویر محصول _ </a>
                {{ $this->product->title }}
            </div>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر</th>
                                <th>نام محصول</th>
                                <th>موقعیت تصویر</th>
                                <th>عملیات</th>

                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)

                            @forelse ($galleries as $gallery)

                            <tr role="row">
                                <td>{{ $gallery->id }}</td>
                                <td>
                                    <img src="/uploads/{{ $gallery->img }}" alt="img" width="50" height="50">
                                </td>
                                <td>
                                    {{ $gallery->product->title }}
                                </td>
                                <td>{{ $gallery->position }}</td>

                                <td>
                                    <a wire:click='remove({{ $gallery->id }})' href="" class="item-delete mlg-15"
                                        title="حذف"></a>

                                    <a href="{{ route('gallery.update',$gallery) }}" class="item-edit "
                                        title="ویرایش"></a>

                                </td>
                            </tr>
                            @empty
                            <div>تصویری وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $galleries->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد تصویر جدید</p>
                <form wire:submit.prevent="gallery" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='gallery.position' type="text" placeholder="موقعیت تصویر"
                            class="form-control">
                        @error('gallery.position')
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

                    <button class="btn btn-brand style"> افزودن تصویر</button>

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
