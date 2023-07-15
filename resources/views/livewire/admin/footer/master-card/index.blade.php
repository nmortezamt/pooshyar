@section('title', 'تصویر فوتر سایت')

<div>
    <div class="main-content" wire:init='loadMaster'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item " href="{{ route('one.index') }}">فوتر لینک یک </a>
                <a class="tab__item" href="{{ route('two.index') }}">فوتر لینک دو </a>
                <a class="tab__item" href="{{ route('title.index') }}">عنوان فوتر صفحه سایت</a>
                <a class="tab__item" href="{{ route('footer_title.index') }}">عناوین اصلی فوتر سایت </a>
                <a class="tab__item is-active" href="{{ route('master_card.index') }}">تصویر فوتر سایت </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text"
                            placeholder="جستجوی تصویر فوتر  ">
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
                                <th> آیدی صفحه سایت </th>
                                <th>عنوان صفحه سایت </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                                @forelse ($masterCards as $master)
                                    <tr role="row">
                                        <td>{{ $master->id }}</td>
                                        <td>{{ $master->page_id }}</td>
                                        <td>
                                            {{ $master->page->title }}
                                        </td>
                                        <td>
                                            <button wire:click='remove({{ $master->id }})' class="item-delete mlg-15"
                                                title="حذف"></button>
                                        </td>
                                    </tr>
                                    @empty
                                    <div>تصویر فوتری وجود ندارد</div>
                                @endforelse

                        </tbody>
                    @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد تصویر فوتر جدید</p>
                <form wire:submit.prevent="master" class="padding-10">
                    <div class="form-group">
                        <select wire:model.lazy='master_card.page_id' name="page_id" class="form-control">
                            <option value="-1">انتخاب تصویر برای فوتر _</option>
                            @foreach (\App\Models\page::all() as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('master_card.page_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>




                    <button class="btn btn-brand style"> افزودن صفحه فوتر سایت </button>

                </form>

            </div>

        </div>

    </div>

</div>
