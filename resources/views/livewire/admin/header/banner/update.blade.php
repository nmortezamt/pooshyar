@section('title',' ویرایش بنر صفحه اصلی')

<div>
    <div class="main-content">
        <div class="row">
            <div class="col-12 bg-white">
                <p class="box__title">ویرایش بنر {{ $banner->title }}</p>
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
                        @elseif($banner->img)
                        <img src="/uploads/{{ $banner->img}}" width="350" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-brand style">ویرایش بنر</button>
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
