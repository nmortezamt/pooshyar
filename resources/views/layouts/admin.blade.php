<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پوشیار | @yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('pooshyar/assets/images/pooshyar.png') }}">

    <link rel="stylesheet" href="{{ asset('panel/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('panel/css/font.css') }}">

    <script src="{{ asset('panel/js/ckeditor.js') }}"></script>

    <script src="{{ asset('panel/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('panel/js/code.highcharts.com_highcharts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        .breadcrumb {
            display: block;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .style {
            margin-top: 10px;
        }

        .dropdown-select {
            display: none;
        }

        .item-restore::before {
            content: "\E0e5";
            font-size: 20px;
            top: 10px;
            right: 15px;
            color: #636e72;
        }

        .table td {
            white-space: nowrap;
            color: #444;
            padding: 13px 7px;
            font-size: 13px;
        }

        .checkbox {
            margin-top: -10px;
        }
    </style>
    <livewire:styles />
</head>

<body>
    @include('sweetalert::alert', ['cdn' => "{{ asset('panel/js/sweetalert2@9.js') }}"])

    @include('livewire.admin.dashboard.sidebar')

    <div class="content">

        @include('livewire.admin.dashboard.header')
        {{ $slot }}
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
    <livewire:scripts />
</body>
<script src="{{ asset('panel/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('panel/js/js.js') }}"></script>
<script src="{{ asset('panel/js/jscolor.js') }}"></script>

</html>
