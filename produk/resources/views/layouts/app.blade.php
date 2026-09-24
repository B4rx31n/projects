<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SB Admin') - {{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('Lumino/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Lumino/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('Lumino/css/styles.css') }}" rel="stylesheet">

    @if(request()->is('tables*') || request()->is('produk*') || request()->is('kategori*') || request()->is('supplier*'))
    <link href="{{ asset('Lumino/css/bootstrap-table.css') }}" rel="stylesheet">
    @endif

    <!-- Custom CSS -->
    <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    @include('partials.navbar')
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <!-- Breadcrumb -->
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><span class="glyphicon glyphicon-home"></span></a></li>
                @yield('breadcrumb')
            </ol>
        </div>

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page-header')</h1>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-lg-12">
                @include('partials.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('Lumino/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('Lumino/js/bootstrap.min.js') }}"></script>

    @stack('scripts')

    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
</body>
</html>
