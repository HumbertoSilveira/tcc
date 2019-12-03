<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{--STYLES--}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-switch/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-duallistbox/bootstrap-duallistbox.min.css') }}">
    
    {{-- DATATABLES --}}
    @if(config('adminlte.plugins.datatables'))
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    @endif
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Google Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

{{--SCRIPTS--}}
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/axios/axios.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

{{--DATATABLES--}}
@if(config('adminlte.plugins.datatables'))
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
@endif
{{--CHART JS--}}
@if(config('adminlte.plugins.chartjs'))
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
@endif

<script src="{{ asset('js/app.js') }}"></script>

@yield('adminlte_js')


<script>
    $(document).ready(function(){
        $('.limpar-cache').on('click', function(e){
            e.preventDefault();
            var $this = $(this);

            swal({
                title: "Limpar todo o cache?",
                text: "Essa ação é irreversível!",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Limpar",
                reverseButtons: true
            }).then(function(result){
                if (result.value) {
                    window.location.href = $this.find('a').attr('href');
                }
            });
        });
    });
</script>

{{-- SWEET ALERT NOTICES --}}
@if(session()->has('alert'))
    <script>
        $(document).ready(function(){
            swal({
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.text') }}",
                type: "{{ session('alert.type') }}",
                confirmButtonColor: "#138ad5",
                confirmButtonText: "Ok"
            })
        });
    </script>
@endif

</body>
</html>
