@section('title','دسترسی ها')
<div>
        <div class="main-content" wire:init='loadPermission'>
            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="{{ route('permission.index') }}">دسترسی ها</a>

                    |
                    <a class="tab__item">:جستجو</a>
                    <a class="t-header-search">
                        <form>
                            <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی دسترسی ">
                </div>
                </form>
                </a>
            </div>

            <div class="row">
                <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                    <div class="table__box">
                        <table class="table">

                            <thead role="rowgroup">
                                <tr role="row" class="title-row">
                                    <th>آیدی</th>
                                    <th> نام دسترسی</th>
                                    <th>توضیح دسترسی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($readyToLoad)
                                @forelse ($permissions as $permission)
                                <tr role="row">
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>
                                        <button wire:click='remove({{ $permission->id }})' href="" class="item-delete mlg-15"
                                            title="حذف"></button>

                                        <a href="{{ route('permission.update',$permission) }}" class="item-edit"
                                            title="ویرایش"></a>
                                    </td>
                                </tr>
                                @empty
                                <div>دسترسی بندی وجود ندارد.</div>
                                @endforelse
                            </tbody>
                            {{ $permissions->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="col-4 bg-white">
                    <p class="box__title">ایجاد دسترسی جدید</p>
                    <form wire:submit.prevent="permission" class="padding-10">

                        <div class="form-group">
                            <input wire:model.lazy='permission.name' type="text" placeholder="نام انگلیسی دسترسی" class="form-control">
                            @error('permission.name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input wire:model.lazy='permission.description' type="text" placeholder=" توضیح دسترسی " class="form-control">
                            @error('permission.description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-brand style"> افزودن دسترسی</button>

                    </form>
                </div>
            </div>
        </div>
</div>
