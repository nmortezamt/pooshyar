@section('title','منو های سایت')

<div>
    <div class="main-content" wire:init='loadHeader'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('header.index') }}">منو های هدر </a>
                <a class="tab__item {{ Request::routeIs('banner.index') ? 'is-active' : ''}} "
                    href="{{ route('banner.index') }}">بنر صفحه اصلی</a>

                    <a class="tab__item {{ Request::routeIs('logo.index') ? 'is-active' : ''}} "
                    href="{{ route('logo.index') }}">لوگو سایت</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی منو ">
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
                                <th>نام منو</th>
                                <th> لینک منو</th>
                                <th> وضعیت منو</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($menus as $menu)
                            <tr role="row">
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->title }}</td>
                                <td>{{ $menu->link }}</td>
                                <td>
                                    @if ($menu->status==1)
                                    <button wire:click="updateCategorydisable({{ $menu->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $menu->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('header.update',$menu) }}" class="item-edit "
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>منویی وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد منو جدید</p>
                <form wire:submit.prevent="menu" class="padding-10">

                    <div class="form-group">
                        <input wire:model.lazy='menu.title' type="text" placeholder="نام منو " class="form-control">
                        @error('menu.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='menu.link' type="text" placeholder=" لینک منو " class="form-control">
                        @error('menu.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model.lazy='menu.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">نمایش در دسته اصلی</label>
                        </div>
                    </div>

                    <button class="btn btn-brand style"> افزودن منو</button>
                </form>
            </div>
        </div>
    </div>
</div>
