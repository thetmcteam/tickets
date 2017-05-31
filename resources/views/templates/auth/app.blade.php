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
                        <div class="section">
                            <h6>Main</h6>
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
                        <div class="section">
                            <h6>Departments</h6>
                            <ul>
                                <li><a href=""><i class="fa fa-square" style="color: #3498db"></i> information techology</a></li>
                                <li><a href=""><i class="fa fa-square" style="color: #e74c3c"></i> human resources</a></li>
                                <li><a href=""><i class="fa fa-square" style="color: #f39c12"></i> verizon</a></li>
                                <li><a href=""><i class="fa fa-square" style="color: #9b59b6"></i> energy</a></li>
                                <li><a href=""><i class="fa fa-square" style="color: #16a085"></i> political</a></li>
                            </ul>
                        </div>
                        <div class="section">
                            <h6>Active Users</h6>
                            <ul>
                                <li><a href=""><i class="fa fa-circle" style="color: #2ecc71"></i> Jordan Bardsley</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: #2ecc71"></i> James Andrews</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: #2ecc71"></i> Tyson Chavarie</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: #2ecc71"></i> Austin Layne</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <a href="" class="navbar-brand">
                                    {{ config('app.name') }}
                                </a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li data-toggle="tooltip" data-placement="bottom" title="open ticket">
                                        <a href="{{ route('tickets.create') }}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="bottom" title="logout">
                                        <a href="">
                                            <i class="fa fa-power-off"></i>
                                        </a>
                                    </li>
                                </ul>
                                <form class="navbar-form navbar-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </form>
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
                
                setTimeout(function () {
                    $('.sub-toolbar').css('height', ($(document).height() - $('.navbar').height()) + 'px');
                }, 250);
            });
        </script>
    </body>
</html>
