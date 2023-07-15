@section('title',' ویرایش برند ')
<div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش برند  _{{ $brands->name }} </p>
        <div class="row no-gutters bg-white">
            <div class="col-8">
                <form wire:submit.prevent="categoryForm" class="padding-20" enctype="multipart/form-data" role="form">



                    <div class="form-group">
                        <input wire:model.lazy='brand.name' type="text" placeholder="نام انگلیسی برند "
                            class="form-control">
                            @error('brand.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='brand.link' type="text" placeholder=" لینک برند " class="form-control">
                        @error('brand.link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>


                    <div class="form-group">
                        <textarea wire:model.lazy='brand.description' type="text" placeholder="توضیح برند " class="form-control">
                        </textarea>
                        @error('brand.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='brand.category_id' class="form-control" >
                            <option value=""> دسته را انتخاب کنید</option>
                            @foreach (\App\Models\category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('brand.category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='brand.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در برند اصلی</label>
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
                        @elseif($brands->img)
                        <img width="400" src="/uploads/{{ $brands->img }}">
                        @endif
                    </div>

                    <button class="btn btn-brand style">ویرایش  برند</button>

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
