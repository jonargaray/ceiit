<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{ url('css/css2.css') }}" rel="stylesheet">

        <!-- Styles -->
        

      
    </head>
    <body class="antialiased">
        <h1>Welcome</h1>
        <div id="vue-app"></div>    

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
