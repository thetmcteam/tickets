<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name") }}</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a href="" class="navbar-brand">
                        helpdesk
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ request()->route()->getName() == 'tickets'  ? 'active' : '' }}">
                            <a href="{{ route('tickets') }}">tickets</a>
                        </li>
                        @if (request()->user()->isAdmin())
                            <li class="{{ request()->route()->getName() == 'users.all'  ? 'active' : '' }}">
                                <a href="/users">users</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="{{ request()->route()->getName() == 'tickets.create'  ? 'active' : '' }}">
                            <a href="/tickets/create"><i class="fa fa-plus"></i></a>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown">
                                <img src="{{ Auth::user()->getImage() }}">
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="disabled"><a>Signed in under<br>{{ Auth::user()->username }}</a></li>
                                <li class="divider"></li>
                                <li><a href="/profile">Profile</a></li>
                                <li><a href="/tickets?query={{ Auth::user()->name }}">Your Tickets</a></li>
                                <li class="divider"></li>
                                <li><a href="/logout">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content" id="app">
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        
    </body>
</html>
