@section('title','دسته ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('category.index') }}">دسته ها </a>
                <a class="tab__item {{ Request::routeIs('subcategory.index') ? 'is-active' : ''}} "
                    href="{{ route('subcategory.index') }}">زیر دسته ها</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی دسته ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('category.trashed') }}"
            >سطل زباله
            ({{ \App\Models\category::onlyTrashed()->count() }})
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر دسته</th>
                                <th>عنوان دسته</th>
                                <th> لینک دسته</th>
                                <th>وضعیت دسته</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($categories as $category)
                            <tr role="row">
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if ($category->img)
                                    <img src="/uploads/{{ $category->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->link }}</td>
                                <td>
                                    @if ($category->status==1)
                                    <button wire:click="updateCategorydisable({{ $category->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $category->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $category->id }})' href="" class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('category.update',$category) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>دسته بندی وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        {{ $categories->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form wire:submit.prevent="category" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='category.title' type="text" placeholder="نام دسته " class="form-control" name="name">
                        @error('category.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='category.link' type="text" placeholder=" لینک دسته " class="form-control" name="link">
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
                            <input wire:model.lazy='category.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در دسته اصلی</label>
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
                    <button class="btn btn-brand style"> افزودن دسته</button>

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
