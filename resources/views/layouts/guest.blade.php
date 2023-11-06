<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" href="{{ asset('images/logo_apk.jpeg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo_apk.jpeg') }}" type="image/x-icon">
    
    @vite('resources/sass/app.scss')

    <style>
        body, .bg-light {
            background-image: url("{{ asset('images/bg_utk_index.png') }}") !important;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
