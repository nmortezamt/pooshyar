@section('title',' ویرایش صفحات سایت ')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش برند  _{{ $pages->title }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="page" class="padding-20" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='page.title' type="text" placeholder="عنوان صفحه سایت  "
                            class="form-control">
                        @error('page.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='page.link' type="text" placeholder=" لینک صفحه سایت" class="form-control">
                        @error('page.link')
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
                        <img src="{{ $image->temporaryUrl()}}" width="300" class="form-control">
                        @elseif($page->img)
                        <img src="/uploads/{{ $page->img}}" width="300" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-brand style"> ویرایش صفحه سایت </button>

                </form>
            </div>
        </div>
    </div>
        {{-- start code script for image --}}
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
{{-- ens script for image --}}
</div>
