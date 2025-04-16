<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }} - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('servers/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('servers/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('servers/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('servers/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('servers/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/commons/favicon.png') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('servers.layouts.sidebar')
        <div id="main">
            @include('servers.layouts.header')

            @yield('content')

            @include('servers.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('servers/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('servers/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('servers/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('servers/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('servers/js/main.js') }}"></script>
</body>

</html>
