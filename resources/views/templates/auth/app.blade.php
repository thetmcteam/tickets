<!DOCTYPE html>
<html>
    <head>
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
                                <li><a href=""><i class="fa fa-home"></i> Dashboard</a></li>
                                <li><a href="{{ route('tickets') }}"><i class="fa fa-ticket"></i> Tickets</a></li>
                                <li><a href=""><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href=""><i class="fa fa-power-off"></i> Logout</a></li>
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
                                <li><a href=""><i class="fa fa-circle" style="color: green"></i> Jordan Bardsley</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: green"></i> James Andrews</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: green"></i> Tyson Chavarie</a></li>
                                <li><a href=""><i class="fa fa-circle" style="color: green"></i> Austin Layne</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="collapse navbar-collapse">
                                <form class="navbar-form navbar-left">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="search something">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-power-off"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="content">
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
