@section('title','بنر تخفیف ویژه')

<div>
    <div class="main-content" wire:init='loadBanner'>

        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item"
                    href="{{ route('end.season.discount') }}">بنر تخفیف آخر ماه</a>
                    <a class="tab__item is-active" href="{{ route('special.discount') }}">تخفیف ویژه </a>

                    <a class="tab__item" href="{{ route('newTask.index') }}">تسک جدید </a>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> تصویر بنر</th>
                                <th> عنوان بنر</th>
                                <th> لینک بنر</th>
                                <th>وضعیت بنر</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($Discounts as $Discount)
                            <tr role="row">
                                <td>{{ $Discount->id }}</td>
                                <td>
                                    @if ($Discount->img)
                                    <img src="/uploads/{{ $Discount->img }}" alt="img" width="200" height="100">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>
                                <td>{{ $Discount->title }}</td>

                                <td>{{ $Discount->link }}</td>
                                <td>
                                    @if ($Discount->status==1)
                                    <button wire:click="updateCategorydisable({{ $Discount->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $Discount->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $Discount->id }})' href="" class="item-delete mlg-15"
                                        title="حذف"> </button>
                                </td>
                            </tr>
                            @empty
                            <div>بنری وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد بنر جدید</p>
                <form wire:submit.prevent="banner" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='Discount.title' type="text" placeholder="عنوان بنر " class="form-control">
                        @error('Discount.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='Discount.link' type="text" placeholder="لینک بنر " class="form-control">
                        @error('Discount.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model.lazy='Discount.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در سایت</label>
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
                    <button class="btn btn-brand style"> افزودن بنر</button>
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
