<div>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        @media screen and (max-width: 480px) {

            .modal-content {
                margin: 30% auto;
                width: 90%;
            }

        }
    </style>
    <div class="close"></div>
    @section('profile','جزئیات حساب | پروفایل - پوشیار')
    <div class="tab-pane" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
        <div class="card">
            <div class="card-header">
                <h3>جزئیات حساب</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-10">

                        <label>نام و نام خانوادگی</label>
                        <button id="open-modal" style="float: left" class="btn-fill-out">
                            @if ($user->name == null)
                            <i class='far fa-plus-square' style='font-size:24px'></i>
                            @else
                            <i class='far fa-edit' style='font-size:24px'></i>
                            @endif
                        </button>
                        <div class="border p-3">{{ $user->name }}</div>
                    </div>

                    <div class="form-group col-md-10">
                        <label>شماره تلفن</label>
                        <div class="border p-3">{{ $user->number }}</div>
                    </div>

                    <div class="form-group col-md-10">
                        <label>آدرس ایمیل</label>
                        <button id="open-modal-two" style="float: left" class=" btn-fill-out">
                            @if ($user->email == null)
                            <i class='far fa-plus-square' style='font-size:24px'></i>
                            @else
                            <i class='far fa-edit' style='font-size:24px'></i>
                            @endif
                        </button>
                        <div class="border p-3">{{ $user->email }}</div>
                    </div>

                    <div class="form-group col-md-10">
                        <label>رمز عبور</label>
                        <button id="open-modal-tree" style="float: left" class="btn-fill-out">
                            @if ($user->password == null)
                            <i class='far fa-plus-square' style='font-size:24px'></i>
                            @else
                            <i class='far fa-edit' style='font-size:24px'></i>
                            @endif
                        </button>
                        <div class="border p-3">{{ $user->password ? '•••••••' : '' }}</div>
                    </div>

                    <div class="form-group col-md-10">
                        <label>عکس پروفایل</label>
                        <button id="open-modal-four" style="float: left" class="btn-fill-out">
                            @if ($user->img == null)
                            <i class='fas fa-upload' style='font-size:24px'></i>
                            @else
                            <i class='far fa-edit' style='font-size:24px'></i>
                            @endif
                        </button>
                        <div class="border p-3">
                            @if ($user->img)
                            <img src="/uploads/{{ $user->img }}" alt="" width="150px" height="auto">
                            @else
                            <div>بدون عکس</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <form wire:submit.prevent='editName'>
                <label for="name">نام جدید:</label>
                <input type="text" wire:model.defer='name' value="{{ $user->name }}" name="name" class="form-control">
                <p>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
                <button class="btn-sm btn-danger mt-2">ویرایش</button>
                <div wire:loading wire:target="editName">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <button type="button" id="close" class="close mt-3" onclick="closeModal()">لغو</button>
            </form>
        </div>
    </div>

    <div id="modalTwo" class="modal">
        <div class="modal-content">
            <form wire:submit.prevent='editEmail'>
                <label for="name">آدرس ایمیل:</label>
                <input type="text" class="form-control" name="email" wire:model.defer='email'>
                <p>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
                <button class="btn-sm btn-danger mt-2">ویرایش</button>
                <div wire:loading wire:target="editEmail">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <button type="button" class="close mt-3" onclick="closeModalTwo()">لغو</button>
            </form>
        </div>
    </div>

    <div id="modalTree" class="modal">
        <div class="modal-content">
            @if ($user->password == null)
            <form wire:submit.prevent='createPassword'>
                <label for="password">رمز عبور جدید:</label>
                <input type="password" id="password" class="form-control" name="password" wire:model.defer='newpass'>
                <p>
                    @error('newpass')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
               <ul>
                <li>حداقل 8 حرف</li>
               </ul>
               <label for="password">تکرار رمز عبور جدید:</label>
               <input type="password" id="password" class="form-control" name="password" wire:model.defer='newrepass'>
               <p>
                @error('newrepass')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </p>
                <button class="btn-sm btn-danger mt-2">ویرایش</button>
                <div wire:loading wire:target="createPassword">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <button type="button" class="close mt-3" onclick="closeModalTree()">لغو</button>
            </form>
            @else
            <form wire:submit.prevent='editPassword'>
                <label for="password">رمز عبور فعلی:</label>
                <input type="password" id="password" class="form-control" name="password" wire:model.defer='currectpass'>
                <a class="text-info" href="{{ route('profile.forget-password') }}">بازیابی رمز عبور</a>

                <p>
                    @error('currectpass')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
                <label for="password">رمز عبور جدید:</label>
                <input type="password" id="password" class="form-control" name="password" wire:model.defer='passedit'>
                <p>
                    @error('passedit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
               <ul>
                <li>حداقل 8 حرف</li>
               </ul>
               <label for="password">تکرار رمز عبور جدید:</label>
               <input type="password" id="password" class="form-control" name="password" wire:model.defer='repass'>
               <p>
                @error('repass')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </p>
                <button class="btn-sm btn-danger mt-2">ویرایش</button>
                <div wire:loading wire:target="editPassword">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <button type="button" class="close mt-3" onclick="closeModalTree()">لغو</button>
            </form>
            @endif
        </div>
    </div>

    <div id="modalFour" class="modal">
        <div class="modal-content">
            <form wire:submit.prevent='editImage'>
                <label for="password">عکس پروفایل:</label>
                <input type="file" class="form-control" name="image" wire:model='image'>
                <p>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </p>
                <span class="mt-2 text-danger" wire:loading wire:target='image'>در حال آپلود...</span>
                <div wire:ignore class="progress mt-2" id="progressbar" style="display: none">
                    <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                </div>
                @if($image)
                <img src="{{ $image->temporaryUrl()}}" style="width: 150px;
                                    height: auto;">
                <br>
                @endif

                <button class="btn-sm btn-danger mt-2">ویرایش</button>
                <div wire:loading wire:target="editImage">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <button type="button" class="close mt-3" onclick="closeModalFour()">لغو</button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("modal");

        // Get the button that opens the modal
        var openModalButton = document.getElementById("open-modal");

        // Get the <span> element that closes the modal
        var closeSpan = document.getElementById("close");

        // When the user clicks on the button, open the modal
        openModalButton.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        closeSpan.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
        }

        // Function to close the modal
        function closeModal() {
        modal.style.display = "none";
        }
    </script>

    <script>
        var modalTwo = document.getElementById("modalTwo");

        // Get the button that opens the modal
        var openModalTwoButton = document.getElementById("open-modal-two");

        // Get the <span> element that closes the modal
        var closeSpan = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        openModalTwoButton.onclick = function() {
        modalTwo.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        closeSpan.onclick = function() {
        modalTwo.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalTwo) {
        modalTwo.style.display = "none";
        }
        }

        // Function to close the modal
        function closeModalTwo() {
        modalTwo.style.display = "none";
        }
    </script>

    <script>
        var modalTree = document.getElementById("modalTree");

            // Get the button that opens the modal
            var openModalTreeButton = document.getElementById("open-modal-tree");

            // Get the <span> element that closes the modal
            var closeSpan = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            openModalTreeButton.onclick = function() {
                modalTree.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            closeSpan.onclick = function() {
                modalTree.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modalTree) {
                modalTree.style.display = "none";
            }
            }

            // Function to close the modal
            function closeModalTree() {
                modalTree.style.display = "none";
            }
    </script>

    <script>
        var modalFour = document.getElementById("modalFour");

            // Get the button that opens the modal
            var openModalFourButton = document.getElementById("open-modal-four");

            // Get the <span> element that closes the modal
            var closeSpan = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            openModalFourButton.onclick = function() {
                modalFour.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            closeSpan.onclick = function() {
                modalFour.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modalFour) {
                modalFour.style.display = "none";
            }
            }

            // Function to close the modal
            function closeModalFour() {
            modalFour.style.display = "none";
            }
    </script>

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
