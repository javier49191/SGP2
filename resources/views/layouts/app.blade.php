<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Iconset -->
    <link rel="stylesheet" href="{{ asset('css/iconset/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iconset/css/mfglabs_iconset.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTable -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/dt.css') }}"> --}}

    @yield('links')

</head>
@yield('loader')
<body class="bg-light">

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('alumnos.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                        <li class="nav-item {{active('alumnos*')}}">
                            <a class="nav-link" href="{{ route('alumnos.index') }}">Alumnos</a>
                        </li>
                        <li class="nav-item {{Request::is('padrinos*') ? 'custom_active active' : ''}}">
                            <a class="nav-link" href="{{ route('padrinos.index') }}">Padrinos</a>
                        </li>
                        <li class="nav-item {{Request::is('aportes*') ? 'custom_active active' : ''}}">
                            <a class="nav-link" href="{{ route('aportes.index') }}">Aportes</a>
                        </li>
                        <li class="nav-item {{Request::is('estados*') ? 'custom_active active' : ''}}">
                            <a class="nav-link" href="{{ route('estados.index') }}">Estados Financieros</a>
                        </li>
                        @if (Auth::user()->role->nombre === 'Admin')
                        <li class="nav-item {{Request::is('usuarios*') ? 'custom_active active' : ''}}">
                            <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>
                        <li class="nav-item {{Request::is('vinculaciones*') ? 'custom_active active' : ''}}">
                            <a class="nav-link" href="{{ route('vinculaciones.index') }}">Vinculaciones</a>
                        </li>
                        @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>-->
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('images/avatar/') }}/{{Auth::user()->avatar}}" alt="" style="width: 32px; height: 32px; border-radius: 50%; margin-right: 5px; vertical-align: center; background-color: white; padding: 1px;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="icon-user"></i> Perfil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-signout icon1x"></i>
                                    {{ __('Salir') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

{{-- <script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script> --}}
@yield('scripts')
</body>

</html>
