@section('title','خبر نامه')

<div>
    <div class="main-content" wire:init='loadNewLatter'>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('newsletter.index') }}">خبر نامه </a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی خبرنامه  ">
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
                                <th>ایمیل</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($newletters as $newletter)
                            <tr role="row">
                                <td>{{ $newletter->id }}</td>
                                <td>{{ $newletter->email }}</td>
                                <td>
                                    <button wire:click='remove({{ $newletter->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>
                                </td>
                            </tr>
                            @empty
                            <div>خبر نامه ای وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $newletters->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد خبرنامه  جدید</p>
                <form wire:submit.prevent="newLatter" class="padding-10">

                    <div class="form-group">
                        <input wire:model.lazy='newletter.email' type="email" placeholder=" ایمیل خبرنامه" class="form-control"
                        style="text-align: right">
                        @error('newletter.email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style"> افزودن خبرنامه </button>
                </form>
            </div>
        </div>
    </div>
</div>
