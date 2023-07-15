@section('title','ویرایش دسته مقاله')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش دسته مقاله _{{ $category->title }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="category" class="padding-20" enctype="multipart/form-data" role="form">


                    <div class="form-group">
                        <input wire:model.lazy='category.title' type="text" placeholder="نام دسته " class="form-control">
                       @error('category.title')
                           <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='category.link' type="text" placeholder=" لینک دسته " class="form-control">
                        @error('category.link')
                           <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='category.description' type="text" placeholder="توضیحات دسته" class="form-control" name="link">
                        @error('category.description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='category.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در دسته اصلی</label>
                        </div>
                    </div>

                    <div>
                        <input type="file" wire:model="image" class="form-control">
                        <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                        <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                            <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>

                    </div>

                    <div>
                        <br>
                        @if ($image)
                        <img width="400" src="{{ $image->temporaryUrl() }}">
                        @elseif ($category->img)
                        <img width="400" src="/uploads/{{ $category->img }}">
                        @endif
                    </div>

                    <button class="btn btn-brand style"> ویرایش دسته</button>

                </form>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor
         .create( document.querySelector( '#description_create' ),{
     language:{
         ui:'fa',

     }
     } )
     .catch( error => {
     console.error( error );
     } );

     ClassicEditor
     .create( document.querySelector( '#body_create' ),{
     language:{
         ui:'fa',
     }
     } )
     .catch( error => {
     console.error( error );
     } );

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
