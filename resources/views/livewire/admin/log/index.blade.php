@section('title',' گزارشات سیستم')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
               <a class="tab__item is-active" href="/admin/log"> گزارشات سیستم</a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form action="" onclick="event.preventDefault();">
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی دسته ">
            </div>
            </form>
            </a>

        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th> کاربر </th>
                                <th> لینک</th>
                                <th> وضعیت</th>
                                <th>تاریخ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)

                            @foreach ($logs as $log)

                            <tr role="row">
                                <td>{{ $log->id }}</td>
                                <td>
                                    @foreach (\App\Models\User::where('id' ,$log->user_id)->get() as $user)
                                        {{ $user->name }}
                                    @endforeach
                                </td>
                                <td>{{ $log->url }}</td>
                                <td>
                                    @if ($log->actionType =='ایجاد')
                                    <span class="badge badge-success" style="background-color: green">ایجاد</span>

                                    @elseif ($log->actionType == 'آپدیت')
                              <span class="badge badge-warning" style="background-color: rgb(16, 247, 255)">آپدیت</span>

                                    @elseif ($log->actionType == 'حذف')
                                    <span class="badge badge-danger" style="background-color: red">حذف</span>

                                    @elseif ($log->actionType == 'فعال')
                                    <span class="badge badge-primary" style="background-color: blue">فعال</span>

                                    @elseif ($log->actionType == 'غیر فعال')
                                    <span class="badge badge-danger" style="background-color: rgb(141, 0, 0)">غیر فعال</span>

                                    @elseif ($log->actionType =='بازیابی')
                                    <span class="badge badge-danger" style="background-color: rgb(251, 185, 63)">بازیابی</span>

                                    @elseif ($log->actionType =='حذف کامل')
                                    <span class="badge badge-danger" style="background-color: rgb(255, 0, 0)">حذف برای همیشه</span>
                                    @endif
                                </td>
                                <th>{{ $log->updated_at->diffForHumans() }}</th>
                            </tr>
                            @endforeach

                        </tbody>
                        {{ $logs->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>



        </div>

    </div>


</div>
