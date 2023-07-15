@section('title','شبکه اجتماعی')

<div>
    <div class="main-content" wire:init='loadSocial'>

        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('social.index') }}">شبکه اجتماعی </a>

                |
                <a class="tab__item">:جستجو</a>
                <a class="t-header-search">
                    <form>
                        <input wire:model.debounce.1000='search' type="text" class="text" placeholder="جستجوی شبکه اجتماعی  ">
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
                                <th> عنوان شبکه اجتماعی </th>
                                <th>آیکن شبکه اجتماعی </th>
                                <th>لینک شبکه اجتماعی </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($readyToLoad)
                            @forelse ($socials as $social)
                            <tr role="row">
                                <td>{{ $social->id }}</td>
                                <td>{{ $social->title }}</td>
                                <td>
                                    <a href="{{ $social->link }}">
                                        @lang("social.$social->type")
                                    </a>
                                </td>
                                <td><a href="/{{ url($social->link) }}" target ='_blank'>{{ $social->link }}</a></td>
                                <td>
                                    <button wire:click='remove({{ $social->id }})' class="item-delete mlg-15"
                                        title="حذف"></button>
                                </td>
                            </tr>
                            @empty
                            <div>شبکه اجتماعی وجود ندارد</div>
                            @endforelse

                        </tbody>
                        {{ $socials->render() }}
                        @else
                        <div class="alert-warning alert">در حال خواندن اطلاعات</div>
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد شبکه اجتماعی  جدید</p>
                <form wire:submit.prevent="social" class="padding-10" >

                    <div class="form-group">
                        <input wire:model.lazy='social.title' type="text" placeholder="عنوان شبکه اجتماعی"
                            class="form-control" name="name">
                        @error('social.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model.lazy='social.type' class="form-control">
                            <option value="-1"> انتخاب شبکه اجتماعی مورد نظر </option>
                            <option value="instagram">اینستاگرام</option>
                            <option value="twitter">توییتر</option>
                            <option value="youtube">یوتیوب</option>
                            <option value="facebook">فیس بوک</option>
                            <option value="whatsapp">واتساپ</option>
                            <option value="telegram">تلگرام</option>
                        </select>
                        @error('social.type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input wire:model.lazy='social.link' type="text" placeholder=" لینک شبکه اجتماعی  " class="form-control" name="link">
                        @error('social.link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-brand style"> افزودن شبکه اجتماعی </button>
                </form>
            </div>
        </div>
    </div>
</div>

