<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Dashboard - UKK App')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    
    <!-- SB Admin Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    
    @yield('styles')
</head>
<body class="sb-nav-fixed">
    <!-- Include Top Navigation -->
    @include('layouts.partials.navbar')
    
    <div id="layoutSidenav">
        <!-- Include Sidebar Navigation -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Area -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('page-title', 'Dashboard')</h1>
                    <ol class="breadcrumb mb-4">
                        @yield('breadcrumb')
                    </ol>
                    
                    <!-- Content Section -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>

            <!-- Include Footer -->
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- Simple DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    
    <!-- SB Admin Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    
    @stack('scripts')
    @yield('scripts')
</body>
</html>