<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/logo-blanco.png') }}" class="img-fluid my-3">
                    </a>
                </li>
                @if (Auth::check())
                <li class="text-white">
                    Hola {{ Auth::user()->name }}
                <li>
                    <a href="{{ url('/') }}">Lista de ordenes</a>
                </li>
                @if (Auth::user()->name == 'Administrador')
                <li>
                    <a href="{{ url('genera-orden') }}">Generar orden</a>
                </li>
                @endif
                <li>
                    <a href="{{ route('logout') }}">Cerrar sesión</a>
                </li>
                @else
                <li class="text-white">Ingresar al sistema</li>
                @endif
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                @yield('content')
                <a href="#menu-toggle" class="d-none btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/typeahead/typeahead.jquery.min.js') }}"></script>
    @yield('scripts')
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>