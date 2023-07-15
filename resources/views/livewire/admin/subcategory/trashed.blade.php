@section('title',' سطل زباله زیر دسته ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{ route('category.index') }}">دسته ها </a>

                <a class="tab__item is-active"
                    href="{{ route('subcategory.index') }}">زیر دسته ها</a>

            </div>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
            href="{{ route('subcategory.index') }}">
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
                                <th>عنوان زیر دسته </th>
                                <th>تصویر زیر دسته</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($subcategories as $subcategory)

                            <tr role="row">
                                <td>{{ $subcategory->id }}</td>
                                <td>{{ $subcategory->title }}</td>
                                <td>
                                    @if ($subcategory->img)
                                    <img src="/uploads/{{ $subcategory->img }}" alt="img" width="50" height="50">
                                        @else
                                        <p>تصویر ندارد</p>
                                    @endif
                                </td>

                                <td>
                                    <a wire:click='remove({{ $subcategory->id }})' class="item-delete mlg-15"
                                        title="حذف"></a>

                                   <a wire:click='restorecategory({{ $subcategory->id }})' class="item-li i-checkouts item-restore"> </a>
                                </td>
                            </tr>
                            @empty
                            <div>زیر دسته وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $subcategories->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
