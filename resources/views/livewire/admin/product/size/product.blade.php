@section('title','سایز محصولات ')

<div>
    <div class="main-content" wire:init='loadCategory'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item">  سایز محصول _ </a>
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
                                <th>نام سایز</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($sizes as $size)

                            <tr role="row">
                                <td>{{ $size->id }}</td>
                                <td>
                                    {{$size->product->title}}
                                </td>
                                <td>{{ $size->name }}</td>

                                <td>
                                    <a wire:click='remove({{ $size->id }})' class="item-delete mlg-15"
                                        title="حذف"></a>

                                    <a href="{{ route('size.update',$size) }}" class="item-edit "
                                        title="ویرایش"></a>

                                </td>
                            </tr>
                            @empty
                            <div>سایزی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $sizes->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد سایز جدید</p>
                <form wire:submit.prevent="size" class="padding-10" enctype="multipart/form-data">

                    <div class="form-group">
                        <input wire:model.lazy='size.name' type="text" placeholder="نام سایز "
                            class="form-control">
                        @error('size.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-brand style"> افزودن سایز</button>

                </form>

            </div>

        </div>

    </div>

</div>
