<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    {{--Google Analytics--}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title')</title>

    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="description" content="@yield('page-description')">
    {{--<meta name="robots" content="{{ is_active_route('produtos') ? 'noindex, nofollow, noarchive' : 'index, follow' }}">--}}

    {{-- FACEBOOK TAGS --}}
    <meta property="og:site_name" content="@yield('page-title')">
    <meta property="og:title" content="@yield('page-title')">
    <meta property="og:description" content="@yield('page-description')">
    <meta property="og:image" content="@yield('page-image')">

    {{--FAVICON --}}

    {{-- STYLES --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/assets/owl.theme.green.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site-breakpoints.css') }}">
    @stack('styles')

    {{-- GOOGLE FONTS --}}

    {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

@yield('content')

{{-- SCRIPTS --}}
<script src="{{ asset('assets/vendor/jquery/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
<script src="{{ asset('assets/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.js') }}"></script>
<script src="{{ asset('assets/vendor/axios/axios.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
@stack('scripts')

{{-- SWEET ALERT NOTICES --}}
@if(session()->has('site-alert'))
    <script>
        $(document).ready(function(){
            swal({
                title: "{{ session('site-alert.title') }}",
                text: "{{ session('site-alert.text') }}",
                type: "{{ session('site-alert.type') }}",
                confirmButtonColor: "#138ad5",
                confirmButtonText: "Ok"
            })
        });
    </script>
@endif

</body>
</html>