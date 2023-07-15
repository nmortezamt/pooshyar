@section('title',' ویرایش تصویر محصول ')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش تصوبر محصول  _ {{ $gallerys->product->title }}
     </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="gallery" class="padding-20" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <select wire:model.lazy='gallery.product_id' class="form-control" name="color_id">
                            <option value="1">تصویر محصول </option>
                            @foreach (\App\Models\product::all() as $product)
                            <option value="{{ $product->id }}"> {{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('gallery.product_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='gallery.position' type="text" placeholder="موقعیت تصویر" class="form-control">
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
                        @else
                        <br>
                        <img src="/uploads/{{ $gallerys->img}}" width="350" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-brand style">ویرایش  تصویر محصول</button>

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
