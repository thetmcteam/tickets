<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name") }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        <div id="app">
            @yield("content")
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
