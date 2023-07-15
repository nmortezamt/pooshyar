<meta charset="UTF-8">

<!-- SITE TITLE -->
@if ( Request::routeIs('home.index'))
<title>تولید و پخش تونیک زنانه - پوشیار</title>
@else
<title>
    @yield('title')
    @yield('profile')
</title>
@endif
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('pooshyar/assets/images/favicon.png') }}">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/animate.css') }}">
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/bootstrap/css/bootstrap.min.css') }}">
<!-- Google Font -->
{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> --}}
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/linearicons.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/simple-line-icons.css') }}">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/owlcarousel/css/owl.theme.default.min.css') }}">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/magnific-popup.css') }}">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/slick-theme.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/responsive.css') }}">
<!-- RTL CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/rtl-style.css') }}">

<!-- jquery-ui CSS -->
<link rel="stylesheet" href="{{ asset('pooshyar/assets/css/jquery-ui.css') }}">


<script src="{{ asset('panel/js/sweetalert2@9.js') }}"></script>

<script src="{{ asset('pooshyar/assets/js/jquery-search.min.js') }}"
integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<style>
       @font-face {
            font-family: iransans;
            src: url('/pooshyar/assets/fonts/IRANSansX-Bold.woff');
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p{
            font-family: iransans;
        }
</style>

