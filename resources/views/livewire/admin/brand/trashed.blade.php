@section('title',' سطل زباله برند ها')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('brand.index') }}">برندها ها </a>
            </div>
            </a>
            <a class="tab__item btn btn-danger text-white" style="margin-top:-40px; margin-left:10px; float:left;"
               href="{{ route('brand.index') }}">
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
                            <th> تصویر برند</th>
                            <th>نام برند</th>
                            <th>دسته برند</th>
                            <th>توضیح برند</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if ($readyToLoad)
                            @forelse ($brands as $brand)

                                <tr role="row">
                                    <td>{{ $brand->id }}</td>
                                    <td>
                                        <img src="/uploads/{{ $brand->img }}" alt="img" width="50" height="50">
                                    </td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @foreach (\Modules\Category\Models\category::where('id',$brand->category_id)->get() as $bran)
                                            {{ $bran->title }}
                                        @endforeach
                                    </td>
                                    <td>{{ $brand->description }}</td>


                                    <td>
                                        <a wire:click='remove({{ $brand->id }})' class="item-delete mlg-15"
                                           title="حذف"></a>

                                        <a wire:click='restorecategory({{ $brand->id }})'
                                           class="item-li i-checkouts item-restore"> </a>
                                    </td>
                                </tr>
                            @empty
                                <div>برندی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $brands->render() }}
                        @else
                            <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
