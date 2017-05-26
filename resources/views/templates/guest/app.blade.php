<!DOCTYPE html>
<html>
    <head>
        <title>{{ config("app.name") }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <a href="" class="navbar-brand">{{ config("app.name") }}</a>
            </div>
        </nav>

        @yield("content")
    </body>
</html>