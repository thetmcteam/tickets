<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name") }}</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <div class="sidebar">
                        <div class="logo">
                            <h3>tmc tickets</h3>
                        </div>
                        <div class="section">
                            <ul>
                                <li class="{{ request()->route()->getName() === 'dashboard' ? 'active' : '' }}">
                                    <a href="">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li class="{{ request()->route()->getName() === 'tickets' ? 'active' : '' }}">
                                    <a href="{{ route('tickets') }}">
                                        <i class="fa fa-ticket"></i> Tickets
                                    </a>
                                </li>
                                <li class="{{ request()->route()->getName() === 'settings' ? 'active' : '' }}">
                                    <a href="">
                                        <i class="fa fa-cog"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li data-toggle="tooltip" data-placement="bottom" title="Open Ticket">
                                        <a href="{{ route('tickets.create') }}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="bottom" title="Profile">
                                        <a href="">
                                            <i class="fa fa-user"></i>
                                        </a>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="bottom" title="Settings">
                                        <a href="">
                                            <i class="fa fa-cog"></i>
                                        </a>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="bottom" title="Logout">
                                        <a href="">
                                            <i class="fa fa-power-off"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
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
