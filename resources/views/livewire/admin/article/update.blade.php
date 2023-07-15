<div>
    @section('title','ویرایش مقاله')
    <div>
        <div class="main-content">
            <div class="row">
                <div class="col-12 bg-white">
                    <p class="box__title">ویرایش مقاله _{{ $article->title }}</p>
                    <form wire:submit.prevent='article' class="padding-10" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input wire:model.lazy='article.title' type="text" placeholder="عنوان مقاله"
                                        class="form-control">
                                    @error('article.title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input wire:model.lazy='article.keyword' type="text" placeholder="کلید واژه مقاله"
                                        class="form-control">
                                    @error('article.keyword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input wire:model.lazy='article.link' type="text" placeholder="لینک مقاله"
                                        class="form-control">
                                    @error('article.link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select wire:model.lazy='article.category_article_id' class="form-control">
                                        <option value="-1">دسته بندی رو انتخاب کنید</option>
                                        @forelse (\App\Models\categoryArticle::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @empty
                                        <option disabled>دسته بندی ای وجود نداره</option>
                                        @endforelse
                                    </select>
                                    @error('article.category_article_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select wire:model.lazy='article.subcategory_article_id' class="form-control">
                                        <option value="">زیر دسته رو انتخاب کنید</option>
                                        @forelse (\App\Models\subcategoryArticle::where('category_article_id',$this->article->category_article_id)->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @empty
                                        <option disabled>دسته بندی ای وجود نداره</option>
                                        @endforelse
                                    </select>
                                    @error('article.subcategory_article_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group" wire:ignore>
                            <textarea wire:model.lazy='article.body' placeholder="متن مقاله" name="body" id="body">{{ $article->body }}
                            </textarea>
                            <script>
                                ClassicEditor
                                .create(document.querySelector('#body'),{
                                language:{
                                ui:'fa'
                                },

                                 ckfinder: {
                                uploadUrl: "{{route('image.upload').'?_token='.csrf_token()}}",
                                },

                                })

                                .then(editor => {
                                editor.model.document.on('change:data', () => {
                                @this.set('article.body', editor.getData());
                                })

                                })
                                .catch(error => {
                                console.error(error);
                                });
                            </script>
                            @error('article.body')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input wire:model.lazy='article.description' type="text" placeholder="توضیح متا مقاله"
                                        class="form-control">
                                    @error('article.description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="notificationGroup">
                            <input id="option1" type="checkbox" wire:model.lazy='article.status' class="form-control" />
                            <label for="option1">وضعیت مقاله</label>
                        </div>

                        <div>
                        <input type="file" class="form-control" wire:model='image'>
                            <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                            <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                                <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div>
                            @if($image)
                            <img src="{{ $image->temporaryUrl()}}" width="200" class="form-control" style="width: 400px">
                            <br>
                            @else
                            <img src="/uploads/{{ $article->img}}" width="200" class="form-control" style="width: 400px">
                            @endif
                        </div>
                        <button class="btn btn-brand">ویرایش کردن</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('livewire:load' ,()=>{
                    let progressSection = document.querySelector('#progressbar'),
                    progressBar =progressSection.querySelector('.progress-bar');
                    document.addEventListener('livewire-upload-start',()=>{
                        console.log('شروع دانلود');
                        progressSection.style.display = 'flex';
                    });
                    document.addEventListener('livewire-upload-finish',()=>{
                        console.log('اتمام دانلود');
                        progressSection.style.display = 'none';
                    });
                    document.addEventListener('livewire-upload-error	',()=>{
                        console.log(' اررور موقع دانلود');
                        progressSection.style.display = 'none';
                    });
                    document.addEventListener('livewire-upload-progress',(event)=>{
                        console.log(`${event.detail.progress}%`);
                        progressBar.style.width = `${event.detail.progress}%`;
                        progressBar.textContent = `${event.detail.progress}%`;

                    });
                });
        </script>

    </div>
    </div>
