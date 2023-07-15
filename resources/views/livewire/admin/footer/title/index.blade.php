@section('title','عنوان فوتر صفحه سایت')

<div>
    <div class="main-content" wire:init='loadTitle'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item " href="{{ route('one.index') }}">فوتر لینک یک </a>
                <a class="tab__item" href="{{ route('two.index') }}">فوتر لینک دو </a>
                <a class="tab__item" href="{{ route('title.index') }}">عنوان فوتر صفحه سایت</a>
                <a class="tab__item  is-active" href="{{ route('footer_title.index') }}">عناوین اصلی فوتر سایت </a>
                <a class="tab__item" href="{{ route('master_card.index') }}">تصویر فوتر سایت </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی صفحه فوتر  ">
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
                                <th>عنوان صفحه سایت </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($footerTitles as $footerTitle)
                            <tr role="row">
                                <td>{{ $footerTitle->id }}</td>
                                <td>{{Str::limit($footerTitle->title, 100) }}</td>

                                <td>
                                    <a href="{{ route('footer_title.update',$footerTitle) }}"
                                    class="item-edit"
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>عنوان فوتری وجود ندارد</div>
                            @endforelse
                        </tbody>
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد عنوان جدید</p>
                <form wire:submit.prevent="title" class="padding-10">

                    <div class="form-group">
                        <input wire:model.lazy='footerTitle.title' type="text" placeholder="عنوان فوتر را وارد کنید  "
                            class="form-control">
                        @error('footerTitle.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-brand style"> افزودن صفحه فوتر سایت </button>
                </form>
            </div>
        </div>
    </div>
</div>
