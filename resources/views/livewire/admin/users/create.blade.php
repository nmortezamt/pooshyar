@section('title','ایجاد کاربر')
<div>
    <div class="main-content">
        <div class="row">
            <div class="col-12 bg-white">
                <p class="box__title"> ایجاد کاربر جدید_{{ $this->user->name }}</p>
                <form wire:submit.prevent='user' class="padding-10" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='user.name' type="text" placeholder="نام کاربر"
                                    class="form-control">
                                @error('user.name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='user.email' type="email" placeholder="ایمیل کاربر"
                                    class="form-control">
                                @error('user.email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='user.number' type="tel" placeholder="شماره تلفن"
                                    class="form-control">
                                @error('user.number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model.lazy='user.password1' type="password" placeholder="پسورد"
                                    class="form-control">
                                @error('user.password1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="notificationGroup">
                        <input id="option1" type="checkbox" wire:model.lazy='user.admin' class="form-control" name="type"/>
                        <label for="option1">کاربر ادمین</label>
                    </div>

                    <div class="notificationGroup">
                        <input id="option2" type="checkbox" wire:model.lazy='user.staff' class="form-control" name="type"/>
                        <label for="option2">کاربر همکار</label>
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
                        @endif
                    </div>
                    <button class="btn btn-brand">اضافه کردن</button>
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
