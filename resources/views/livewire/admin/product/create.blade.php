@section('title',' افزودن محصول')
<div>
    <div class="main-content">
        <div class="row">
            <div class="col-12 bg-white">
                <p class="box__title">افزودن محصول جدید
                    @if ($this->product->title)
                        _
                        {{ $this->product->title }}
                    @endif
                </p>
                <form wire:submit.prevent="product" class="padding-30" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='product.title' type="text" placeholder="نام محصول "
                                       class="form-control" name="name">
                                @error('product.title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='product.number' type="text" placeholder="تعداد موجودی محصول"
                                       class="form-control">
                                @error('product.number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='product.order_count' type="text"
                                       placeholder="تعداد سفارش محصول(صفر نامحدود) :" class="form-control">
                                @error('product.order_count')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select wire:model.lazy='product.category_id' class="form-control" name="category_id">
                                    <option value="1"> _دسته اصلی</option>
                                    @foreach (\Modules\Category\Models\category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('product.category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select wire:model.lazy='product.subcategory_id' class="form-control"
                                        name="subcategory_id">
                                    <option value=""> _زیر دسته</option>
                                    @foreach (\App\Models\subcategory::
                                    where('parent',$this->product->category_id)->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('product.subcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select wire:model.lazy='product.brand_id' class="form-control">
                                    <option value=""> _برند</option>
                                    @foreach (\Modules\Product\Brand\Models\brand::all() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('product.brand_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                            <textarea wire:model.lazy='description' type="text" placeholder=" توضیح کوتاه محصول"
                                      class="form-control" id="description" name="description">
                            </textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#description'), {
                                    language: {
                                        ui: 'fa'
                                    },

                                })

                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                    @this.set('description', editor.getData())
                                        ;
                                    })

                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>

                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group" wire:ignore>
                            <textarea wire:model.lazy='body' type="text" placeholder=" توضیح محصول"
                                      class="form-control" id="body" name="body">
                             </textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#body'), {
                                    language: {
                                        ui: 'fa'
                                    },

                                })

                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                    @this.set('body', editor.getData())
                                        ;
                                    })

                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                        @error('body')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                            <textarea wire:model.lazy='product.description_seo' type="text"
                                      placeholder=" توضیح سئو محصول"
                                      class="form-control" id="description" name="description">
                            </textarea>
                        @error('product.description_seo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input wire:model.lazy='product.price' type="text" placeholder="قیمت محصول"
                                       class="form-control">
                                @error('product.price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input wire:model.lazy='product.price_major'
                                       type="text" placeholder="قیمت محصول (عمده)"
                                       class="form-control form-group">
                                @error('product.price_major')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input wire:model.lazy='product.discount_price' type="text"
                                       placeholder="درصد تخفیف (اختیاری)" class="form-control">
                                <span class="text-danger">در صورت نیاز بدون علامت % باشد</span>
                                @error('product.discount_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input wire:model.lazy='product.time'
                                       type="text" placeholder="زمان ارسال محصول به روز"
                                       class="form-control form-group">
                                @error('product.time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="notificationGroup">
                                    <input wire:model='product.shipment' type="checkbox" id="option7"
                                           class="form-control"
                                           name="shipment">
                                    <label for="option7">موجود در انبار پوشیار:</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="notificationGroup">
                                    <input wire:model='product.publish' type="checkbox" id="option6"
                                           class="form-control"
                                           name="publish">
                                    <label for="option6">منتشر شده:</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="notificationGroup">
                                    <input wire:model='product.status' type="checkbox" id="option4" class="form-control"
                                           name="status">
                                    <label for="option4">وضعیت محصول</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <input type="file" class="form-control" wire:model='image'>
                        <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                        <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                            <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>

                    <div>
                        @if($image)
                            <img src="{{ $image->temporaryUrl()}}" width="200" class="form-control"
                                 style="width: 400px">
                        @endif
                    </div>
                    <br>
                    <button class="btn btn-brand">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('livewire:load', () => {
            let progressSection = document.querySelector('#progressbar'),
                progressBar = progressSection.querySelector('.progress-bar');
            document.addEventListener('livewire-upload-start', () => {
                console.log('شروع دانلود');
                progressSection.style.display = 'flex';
            });
            document.addEventListener('livewire-upload-finish', () => {
                console.log('اتمام دانلود');
                progressSection.style.display = 'none';
            });
            document.addEventListener('livewire-upload-error	', () => {
                console.log(' اررور موقع دانلود');
                progressSection.style.display = 'none';
            });
            document.addEventListener('livewire-upload-progress', (event) => {
                console.log(`${event.detail.progress}%`);
                progressBar.style.width = `${event.detail.progress}%`;
                progressBar.textContent = `${event.detail.progress}%`;

            });
        });
    </script>

</div>
