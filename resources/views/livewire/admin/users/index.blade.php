@section('title','کاربران')
<div>
        <div class="main-content" wire:init='loadUsers'>
            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="{{ route('users.index') }}">کاربران</a>
                    {{-- <a class="tab__item" href="{{ route('users.confirm') }}">کاربران تایید شده</a>
                    <a class="tab__item" href="{{ route('users.not.confirm') }}">کاربران تایید نشده</a> --}}
                    <a class="tab__item" href="{{ route('user.create') }}">ایجاد کاربر</a>
                    |
                    <a class="tab__item">:جستجو</a>
                    <a class="t-header-search">
                        <form>
                            <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی کاربر ">
                </div>
                </form>
                </a>
                <div style="margin-right:10px ">تعداد کل کاربر ها:{{ count($users) }}</div>
                {{-- <div style="margin-right:10px ">تعداد کاربرهای تایید شده:{{ $user_confirm }}</div> --}}
                {{-- <div style="margin-right:10px ">تعداد کاربرهای تایید نشده:{{ $user_not_confirm }}</div> --}}

            </div>

            <div class="row">
                <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                    <div class="table__box">
                        <table class="table">

                            <thead role="rowgroup">
                                <tr role="row" class="title-row">
                                    <th>آیدی</th>
                                    <th>عکس کاربر</th>
                                    <th>نام کاربر</th>
                                    <th>ایمیل کاربر</th>
                                    <th>شماره کاربر</th>
                                    <th>سطح کاربر</th>
                                    <th>تایید ایمیل کاربر</th>
                                    <th>تاریخ عضویت</th>
                                    <th>آخرین فعالیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($readyToLoad)
                                @forelse ($users as $user)
                                <tr role="row">
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if ($user->img)
                                        <img src="/uploads/{{ $user->img }}" alt="img" width="50" height="50">
                                            @else
                                        <p>تصویر ندارد</p>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->number }}</td>
                                    <td>
                                        @if ($user->admin == 1)
                                        <div class="alert-sm alert-primary">مدیر</div>
                                        @elseif($user->staff == 1)
                                        <div class="alert-sm" style="background-color: rgb(113, 251, 113)">همکار</div>

                                        <div class="alert-sm text-white" style="background-color: rgb(255, 95, 26)"><a href="{{ route('users.permission',$user) }}">دسترسی دادن</a></div>
                                        @else
                                        <div class="alert-sm" style="background-color: rgb(253, 195, 22)">عادی</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->email_verified_at == null)
                                        <div class="alert-sm alert-danger" wire:click='confirmUser({{ $user->id }})'>تایید نشده</div>
                                        @else
                                        <div class="alert-sm alert-success">تایید شده</div>
                                        @endif
                                    </td>
                                    <td>{{ jdate($user->created_at)->format('%Y/%m/%d') }}</td>
                                    <td>{{ $user->active }}</td>

                                    <td>
                                        <button wire:click='remove({{ $user->id }})' href="" class="item-delete mlg-15"
                                            title="حذف"></button>

                                        <a href="{{ route('user.update',$user) }}" class="item-edit"
                                            title="ویرایش"></a>
                                    </td>
                                </tr>
                                @empty
                                <div>کاربری وجود ندارد</div>
                                @endforelse
                            </tbody>
                            {{ $users->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
