@section('title','عنوان فوتر صفحه سایت')

<div>
    <div class="main-content" wire:init='loadTitle'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item " href="{{ route('one.index') }}">فوتر لینک یک </a>
                <a class="tab__item" href="{{ route('two.index') }}">فوتر لینک دو </a>
                <a class="tab__item is-active" href="{{ route('title.index') }}">عنوان فوتر صفحه سایت</a>
                <a class="tab__item" href="{{ route('footer_title.index') }}">عناوین اصلی فوتر سایت </a>
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
                                <th> آیدی صفحه سایت </th>
                                <th>عنوان صفحه سایت </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($FooterlinkTitles as $footer)
                            <tr role="row">
                                <td>{{ $footer->id }}</td>
                                <td>{{ $footer->page_id }}</td>
                                <th>
                                   {{ $footer->page->title }}
                                </th>
                                <td>
                                    <a href="{{ route('title.update',$footer) }}"
                                    class="item-edit"
                                        title="ویرایش"></a>
                                </td>
                            </tr>
                            @empty
                            <div>عنوانی وجود ندارد</div>
                            @endforelse
                        </tbody>
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد صفحه فوتر سایت جدید</p>
                <form wire:submit.prevent="title" class="padding-10">
                    <div class="form-group">
                        <select wire:model.lazy='FooterlinkTitle.page_id' name="page_id" class="form-control">
                            <option value="-1">انتخاب صفحه برای فوتر _</option>
                            @foreach (\App\Models\page::all() as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('FooterlinkTitle.page_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <button class="btn btn-brand style"> افزودن صفحه فوتر سایت </button>
                </form>
            </div>
        </div>
    </div>
</div>