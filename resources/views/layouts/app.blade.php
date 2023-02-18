<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CEIIT</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ url('css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ url('/logo/logo4.png') }}" />

</head>
<body class="gray-bg">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ajax-script.js') }}"></script>
     <!-- Input Mask-->
<script type="text/javascript" src="{{ url('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

</html>
