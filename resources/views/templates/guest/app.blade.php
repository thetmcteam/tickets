<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name") }}</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body style="background-color: #2c3e50">

        <div id="app">
            @yield("content")
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
