<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="fa">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('livewire.home.home.head')
    <livewire:styles />
</head>

<body dir="rtl">
    @include('sweetalert::alert', ['cdn' => "{{ asset('panel/js/sweetalert2@9.js') }}"])



    <div class="main_content">

        <div class="section">
            <div class="container">
                <div class="row">
                    @include('livewire.home.profile.content.sidebar')
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content dashboard_content">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            document.addEventListener('livewire:load', () => {
                livewire.on('toast', (type, message) => {
                    Toast.fire({
                        icon: type,
                        title: message
                    })
                })
            })
        </script>
    </div>

    <!-- START FOOTER -->
    @include('livewire.home.home.footer')
    <!-- END FOOTER -->
    <livewire:scripts />
</body>

</html>
