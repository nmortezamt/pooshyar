    @section('title','ویرایش زیر دسته')
    <div>
        <div class="main-content padding-0">
            <p class="box__title">ویرایش زیر دسته _{{ $subcategory->title }} </p>
            <div class="row no-gutters bg-white">
                <div class="col-8">
                    <form wire:submit.prevent="subCategory" class="padding-20" enctype="multipart/form-data" role="form">

                        <div class="form-group">
                            <input wire:model.lazy='subcategory.title' type="text" placeholder="عنوان زیر دسته " class="form-control">
                            @error('subcategory.title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input wire:model.lazy='subcategory.link' type="text" placeholder="لینک زیر دسته "
                                class="form-control">
                            @error('subcategory.link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input wire:model.lazy='subcategory.description' type="text" placeholder="توضیح زیر دسته "
                                class="form-control">
                            @error('subcategory.description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select wire:model.lazy='subcategory.parent' name="" id="" class="form-control" >
                                <option value="">سر دسته را انتخاب کنید</option>
                                @foreach (\App\Models\category::where('status',1)->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('subcategory.parent')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            @elseif($subcategory->img)
                            <img width="400" src="/uploads/{{ $subcategory->img }}">
                            @endif
                        </div>

                        <button class="btn btn-brand style"> ویرایش زیر دسته</button>

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
