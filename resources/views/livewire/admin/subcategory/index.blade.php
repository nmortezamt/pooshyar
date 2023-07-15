@section('title','زیر دسته ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('category.index') }}">دسته ها </a>

                <a class="tab__item is-active"
                    href="{{ route('subcategory.index') }}">زیر دسته ها</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی زیردسته ">
            </div>
            </form>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-60px; margin-left:10px; float:left;"
            href="{{ route('subcategory.trashed') }}">سطل زباله
            ({{ \App\Models\subcategory::onlyTrashed()->count() }})
            </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>عنوان زیر دسته </th>
                                <th>تصویر زیر دسته</th>
                                <th>لینک زیر دسته</th>
                                <th>مشخصات کالا</th>
                                <th>سر دسته</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($subcategorys as $subcategory)
                            <tr role="row">
                                <td>{{ $subcategory->id }}</td>
                                <td>{{ $subcategory->title }}</td>
                                <td>
                                    @if ($subcategory->img)
                                    <img src="/uploads/{{ $subcategory->img }}" alt="img" width="50" height="50">
                                    @else
                                    <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $subcategory->link }}</td>
                                <td>
                                    <a href="{{ route('subcategory.attribute',$subcategory) }}" title="مشخصات فنی"
                                    style="margin-right:10px"><img src="{{ asset('icon/icons/list-check.svg') }}"
                                        width='20' style="margin-top: -5px;"></a>
                                </td>
                                <td>
                                    {{$subcategory->category->title }}
                                </td>

                                <td>
                                    <button wire:click='remove({{ $subcategory->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('subcategory.update',$subcategory) }}"
                                    class="item-edit"
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $subcategorys->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- start create form for subcategory --}}

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد زیر دسته جدید</p>
                <form wire:submit.prevent="subCategory" class="padding-10" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <input wire:model.lazy='subcategories.title' type="text" placeholder="نام زیر دسته "
                            class="form-control" name="name">
                        @error('subcategories.title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='subcategories.link' type="text" placeholder="لینک زیر دسته "
                            class="form-control">
                        @error('subcategories.link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='subcategories.description' type="text" placeholder="توضیح زیر دسته "
                            class="form-control">
                        @error('subcategories.description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='subcategories.parent'  class="form-control">
                            <option>دسته را انتخاب کنید</option>
                            @foreach (\App\Models\category::where('status',1)->get() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('subcategories.parent')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="file" wire:model="image" class="form-control" name="image">
                        <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                        <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                            <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($image)
                        <img width="400" src="{{ $image->temporaryUrl() }}" class="form-control">
                        @endif
                    </div>

                    <button class="btn btn-brand style"> افزودن دسته</button>

                </form>
            {{-- end create form for subcategory --}}

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
