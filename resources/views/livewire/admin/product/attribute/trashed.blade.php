@section('title',' سطل زباله مشخصات کالا کودک')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('attribute.trashed') }}">مشخصات کالا </a>
            </div>

            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
            href="{{ route('attribute.index') }}">
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
                                <th>عنوان </th>
                                <th>دسته نمایش کالا</th>
                                <th>زیر دسته مشخصات</th>
                                <th>موقعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($readyToLoad)
                            @foreach ($attributes as $attribute)

                            <tr role="row">
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->title }}</td>


                                <td>
                                        @foreach (\App\Models\subcategory::where('id',$attribute->subcategory_id)->get() as $cate)
                                        {{ $cate->title }}
                                        @endforeach

                                </td>

                                <td>
                                    @if ($attribute->parent ==0)
                                    سر دسته مشخصات
                                    @else
                                    @foreach (\App\Models\attribute::where('id',$attribute->parent)->get() as $cate)
                                    {{ $cate->title }}
                                    @endforeach
                                    @endif
                            </td>
                            <td>{{ $attribute->position }}</td>

                            <td>
                                <a wire:click='remove({{ $attribute->id }})' class="item-delete mlg-15"
                                    title="حذف"></a>

                               <a wire:click='restorecategory({{ $attribute->id }})' class="item-li i-checkouts item-restore" title="بازیابی"> </a>
                            </td>
                            </tr>
                            @endforeach
                            {{ $attributes->render() }}
                            @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
