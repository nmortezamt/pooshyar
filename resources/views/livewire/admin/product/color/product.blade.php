@section('title','رنگ محصولات ')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item">  رنگ محصول _ </a>
           {{ $this->product->title }}
            </div>
        </div>

        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>آیدی</th>
                                <th>نام محصول</th>
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
                                <td>
                                    {{$color->product->title}}
                                </td>
                                <td>{{ $color->name }}</td>
                                <td><a style="background-color: {{ $color->value }}">{{ $color->value }}</a></td>

                                <td>
                                    <a wire:click='remove({{ $color->id }})' class="item-delete mlg-15"
                                        title="حذف"></a>

                                    <a href="{{ route('color.update',$color) }}" class="item-edit "
                                        title="ویرایش"></a>

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

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد رنگ جدید</p>
                <form wire:submit.prevent="color" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='color.name' type="text" placeholder="نام رنگ "
                            class="form-control">
                        @error('color.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input data-jscolor="" wire:model.lazy='color.value' type="text" placeholder="کد رنگ" class="form-control">
                        @error('color.value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style"> افزودن رنگ</button>

                </form>

            </div>

        </div>

    </div>

</div>
