@section('title',' افزودن مشخصات کالا')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item">مشخصات کالا _</a>
                {{ $this->subcategroy->title }}
                <a class="tab__item btn btn-danger text-white" style=" margin-left:10px; float:left;"
                    href="{{ route('attribute.trashed') }}">سطل زباله
                    ({{ \App\Models\attribute::onlyTrashed()->count() }})
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>عنوان </th>
                                <th>زیر دسته مشخصات</th>
                                <th>موقعیت</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @foreach ($attributes as $attribute)

                            <tr role="row">
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->title }}</td>
                                <td>
                                    @if ($attribute->parent ==0)
                                    سر دسته مشخصات
                                    @else
                                    @foreach (\App\Models\attribute::where('id',$attribute->parent)->get() as $cate)
                                    {{ $cate->title }}
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if ($attribute->status==1)
                                    <button wire:click="updateCategorydisable({{ $attribute->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $attribute->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>{{ $attribute->position }}</td>
                                <td>
                                    <button wire:click='remove({{ $attribute->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>

                                    <a href="{{ route('attribute.update',$attribute) }}" class="item-edit"
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $attributes->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>

                            @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد مشخصات فنی کالا</p>
                <form wire:submit.prevent="attribute" class="padding-10" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                        <input wire:model.lazy='attribute.title' type="text" placeholder="عنوان مشخصات کالا "
                            class="form-control">
                        @error('attribute.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <select wire:model.lazy='attribute.parent' name="" id="" class="form-control">
                            <option value="-1">انتخاب زیر دسته مشخصات کالا _</option>
                            <option value="0">سر دسته اصلی مشخصات کالا _</option>
                            @foreach (\App\Models\attribute::where('parent',0)->get() as $attribute)
                            <option value="{{ $attribute->id }}">--{{ $attribute->title }}</option>
                            @endforeach
                        </select>
                        @error('attribute.parent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='attribute.position' type="text" placeholder="موقعیت مشخصات کالا "
                            class="form-control">
                        @error('attribute.position')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model='attribute.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در دسته اصلی</label>
                        </div>
                    </div>


                    <button class="btn btn-brand style"> افزودن مشخصات کالا</button>

                </form>

            </div>

        </div>

    </div>

</div>
