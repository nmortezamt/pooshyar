<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <!-- Meta -->

    {!! SEO::generate() !!}
    {!! JsonLd::generate() !!}



    <meta name="googlebot" content="index,follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="HandheldFriendly" content="true">
    <meta itemprop="url" content="http://{{ $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}">
    <link rel="alternate" hreflang="fa-IR" href="http://{{ $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="fa">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('livewire.home.home.head')
    <livewire:styles />
</head>

<body dir="rtl">
    @include('sweetalert::alert', ['cdn' => "{{ asset('panel/js/sweetalert2@9.js') }}"])


    {{ $slot }}
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
