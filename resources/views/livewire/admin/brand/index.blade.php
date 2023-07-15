@section('title','برندها ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('brand.index') }}">برندها ها </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی برند ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('brand.trashed') }}"
            >سطل زباله
            ({{ \App\Models\brand::onlyTrashed()->count() }})
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر برند</th>
                                <th>نام برند</th>
                                <th>دسته برند</th>
                                <th>توضیح برند </th>
                                <th>وضعیت برند</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($brands as $brand)

                            <tr role="row">
                                <td>{{ $brand->id }}</td>
                                <td>
                                    @if ($brand->img)
                                    <img src="/uploads/{{ $brand->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    {{ $brand->category->title }}
                                </td>
                                <td>{{ $brand->description }}</td>

                                <td>
                                    @if ($brand->status==1)
                                    <button wire:click="updateCategorydisable({{ $brand->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $brand->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $brand->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('brand.update',$brand) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>برندی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $brands->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد برند جدید</p>
                <form wire:submit.prevent="brand" class="padding-10" enctype="multipart/form-data">

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
                        <select wire:model.lazy='brand.category_id' class="form-control">
                            <option value=""> دسته برند را انتخاب کنید</option>
                            @foreach (\App\Models\category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('brand.category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    <div class="form-group">
                        <textarea wire:model.lazy='brand.description' type="text" placeholder="توضیح برند " class="form-control">
                        </textarea>
                        @error('brand.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='brand.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در برند اصلی</label>
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
                        @endif
                    </div>
                    <button class="btn btn-brand style"> افزودن برند</button>

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
