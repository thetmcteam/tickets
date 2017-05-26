<!DOCTYPE html>
<html>
    <head>
        <title>{{ config("app.name") }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @yield("content")
    </body>
</html>