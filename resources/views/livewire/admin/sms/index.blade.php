<div>
    @section('title',' پیامک ها')
<div>
    <div class="main-content" wire:init='loadSms'>
        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item" href="{{ route('orders.index') }}">پیامک ها</a>
                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی پیامک ">
            </div>
            </form>
            </a>

        </div>

        <div class="table__box">
            <table class="table table-bordered">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>آیدی</th>
                    <th>کد</th>
                    <th>کاربر</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                </thead>
                <tbody>
                @if ($readyToLoad)
                @forelse ($sms_code as $sms)
                <tr role="row">
                    <td>{{ $sms->id }}</td>
                    <td>{{ $sms->code }}</td>
                    <td>
                        {{ $sms->user->name ?? $sms->user->id}}
                    </td>

                    <td>{{ jdate($sms->created_at)->format('%Y/%m/%d') }}</td>

                </tr>
                @empty
                <div>پیامکی وجود ندارد</div>
                @endforelse
                {{ $sms_code->render() }}
                @else
                <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
