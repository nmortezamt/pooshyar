@section('title','کد تخفیف ها')

<div>
    <div class="main-content" wire:init='loadDiscount'>

        <div class="tab__box">
            <div class="tab__items">

                <a class="tab__item is-active"
                    href="{{ route('discount.code.index') }}">کد تخفیف </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی کد تخفیف ">
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
                                <th>کد تخفیف</th>
                                <th>مبلغ تخفیف</th>
                                <th>درصد تخفیف</th>
                                <th>تاریخ ایجاد</th>
                                <th>تاریخ اتنقضا</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($discounts as $discount)
                            <tr role="row">
                                <td>{{ $discount->id }}</td>
                                <td>{{ $discount->code }}</td>
                                <td>{{ $discount->price ?? 'ندارد'}}</td>
                                <td>{{ $discount->percent ?? 'ندارد'}}</td>
                                <td>{{ jdate($discount->created_at)->format('%Y/%m/%d') }}</td>
                                <td>{{ jdate($discount->date)->format('%Y/%m/%d') }}</td>
                                <td>
                                    @if ($discount->status==1)
                                    <button wire:click="updateCategorydisable({{ $discount->id }})"
                                        class="badge-success badge" style="background-color: green">فعال
                                    </button>
                                    @else
                                    <button wire:click='updateCategoryinable({{ $discount->id }})'
                                        class="badge-danger badge" style="background-color: red"> غیر فعال
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click='remove({{ $discount->id }})' href="" class="item-delete mlg-15"
                                        title="حذف"> </button>
                                </td>
                            </tr>
                            @empty
                            <div>کد تخفیفی وجود ندارد.</div>
                            @endforelse
                        </tbody>
                        {{ $discounts->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد کد تخفیف جدید</p>
                <form wire:submit.prevent="discount" class="padding-10" enctype="multipart/form-data">

                    <span class="text-info">فقط یک فیلد را پر کنید</span>
                    <div class="form-group">
                        <input wire:model.lazy='discount.price' type="text" placeholder="قیمت تخفیف" class="form-control">
                        @error('discount.price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input wire:model.lazy='discount.percent' type="text" placeholder="درصد تخفیف" class="form-control">
                        @error('discount.percent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span class="text-warning">از نشانه % استفاده نکنید فقط عدد درصد را وارد کنید</span>
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='discount.date' type="date"  class="form-control">
                        @error('discount.date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="notificationGroup">
                            <input wire:model.lazy='discount.status' type="checkbox" id="option4" class="form-control"
                                name="status">
                            <label for="option4">وضعیت کد تخفیف</label>
                        </div>
                    </div>

                    <button class="btn btn-brand style">افزودن</button>

                </form>
            </div>
        </div>
    </div>

</div>
