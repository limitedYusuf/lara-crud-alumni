<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" href="{{ asset('images/logonew.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logonew.png') }}" type="image/x-icon">

    @vite('resources/sass/app.scss')
    @stack('css')

    <style>
        .custombody {
            background-image: url("{{ asset('images/bg_utk_dashboard.jpeg') }}") !important;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .invalid-feedback {
            display: block !important;
        }
    </style>
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img class="sidebar-brand-full" width="118px" height="46px" src="{{ asset('images/logonew.png') }}"
                alt="">
            <img class="sidebar-brand-narrow" width="46" height="46" src="{{ asset('images/logonew.png') }}"
                alt="">
        </div>
        @include('layouts.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light {{ Route::has('home') == true ? 'custombody' : '' }}">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                    </svg>
                </button>
                <a class="header-brand d-md-none" href="#">
                    <img width="118px" height="46px" src="{{ asset('images/logonew.png') }}" alt="">
                </a>
                <ul class="header-nav d-none d-md-flex">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
                </ul>
                <ul class="header-nav ms-auto">

                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                                {{ __('My profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                    </svg>
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">BS5 Template</a> &copy;
                {{ date('Y') }}
                Your Name.
            </div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/ui-components/">SMA Pelita Tiga
                    Components</a></div>
        </footer>
    </div>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    @stack('js')
</body>

</html>
