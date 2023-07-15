@section('title',' ویرایش لوگو سایت')

<div>
    <div class="main-content">
        <div class="row">
            <div class="col-12 bg-white">
                <p class="box__title">ویرایش لوگو {{ $this->logo->id }}</p>
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
                        <br>
                        @if($image)
                        <img src="{{ $image->temporaryUrl()}}" width="250" class="form-control">
                        @elseif($logo->img)
                        <img src="/uploads/{{ $logo->img}}" width="250" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-brand style"> ویرایش لوگو</button>
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
