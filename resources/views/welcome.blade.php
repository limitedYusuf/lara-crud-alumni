<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        body {
            background-image: url("{{ asset('images/bg_utk_dashboard.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            color: white !important;
        }
        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .center-content {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="center-content">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
            <p>This is the welcome page.</p>
            <a href="{{ route('alumni.login') }}" class="btn btn-primary btn-lg">LOGIN</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
