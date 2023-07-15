@section('title',' سطل زباله رنگ')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('color.index') }}">  رنگ محصولات </a>
            </div>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
            href="{{ route('color.index') }}">
            برگشت
            </a>
        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>نام رنگ</th>
                                <th>کد رنگ</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($colors as $color)

                            <tr role="row">
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td><a style="background-color: {{ $color->value }}">{{ $color->value }}</a></td>

                                <td>
                                    <a wire:click='remove({{ $color->id }})' class="item-delete mlg-15"
                                        title="حذف"></a>

                                   <a wire:click='restorecategory({{ $color->id }})' class="item-li i-checkouts item-restore"> </a>
                                </td>
                            </tr>
                            @empty
                            <div>رنگی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $colors->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
