@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="toolbar">
            <div class="pull-left">
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="query" value="{{ request()->get('query') ?: '' }}" placeholder="Search tickets...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right hidden-xs">
                <a class="btn btn-primary" href="/tickets/create">
                    Open Ticket
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tickets

                <ul class="filters list-inline pull-right hidden-xs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Department <span class="caret"></span></a>
                        <ul class="dropdown-menu custom-menu">
                            <li class="header">Department</li>
                            @foreach ($departments as $department)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(array_merge($query, [ 'department' => $department->getId() ])) }}">
                                        <i class="fa fa-square" style="color: {{ $department->getColor()  }}"></i>
                                        {{ $department->getName() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Status <span class="caret"></span></a>
                        <ul class="dropdown-menu custom-menu">
                            <li class="header">Status</li>
                            @foreach ($statuses as $status)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(array_merge($query, [ 'status' => $status->getId() ])) }}">
                                        <i class="fa fa-square" style="color: {{ $status->getColor()  }}"></i>
                                        {{ $status->getName() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Type <span class="caret"></span></a>
                        <ul class="dropdown-menu custom-menu">
                            <li class="header">Type</li>
                            @foreach ($types as $type)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(array_merge($query, [ 'type' => $type->getId() ])) }}">
                                        <i class="fa fa-square" style="color: {{ $type->getColor()  }}"></i>
                                        {{ $type->getName() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Priority <span class="caret"></span></a>
                        <ul class="dropdown-menu custom-menu">
                            <li class="header">Priority</li>
                            @foreach ($priorities as $priority)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(array_merge($query, [ 'priority' => $priority->getId() ])) }}">
                                        <i class="fa fa-square" style="color: {{ $priority->getColor()  }}"></i>
                                        {{ $priority->getName() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                @if ($tickets->count() > 0)
                    @foreach ($tickets as $ticket)
                        <div class="ticket">
                            <div class="pull-left">
                                <h3>
                                    <span class="title">
                                        <span class="status">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                        <a class="department" href="/tickets?query={{ $ticket->department()->first()->department }}">
                                            {{ $ticket->department()->first()->department }}
                                        </a>
                                        <a href="/tickets/{{ $ticket->id }}">{{ $ticket->title }}</a>
                                    </span>

                                    <span class="label" style="background-color: {{ $ticket->type()->first()->color }}">
                                        {{ $ticket->type()->first()->type }}
                                    </span>
                                    <span class="label" style="background-color: {{ $ticket->status()->first()->color  }}">
                                        {{ $ticket->status()->first()->status }}
                                    </span>
                                    <span class="label" style="background-color: {{ $ticket->priority()->first()->color  }}">
                                        {{ $ticket->priority()->first()->priority }}
                                    </span>
                                </h3>
                                <h4>
                                    #{{ $ticket->id }} opened on {{ date('F jS', strtotime($ticket->created_at)) }} by <a href="/tickets/?query={{ $ticket->user()->first()->name }}">{{ $ticket->user()->first()->name }}</a>
                                </h4>
                            </div>
                            <div class="meta pull-right hidden-xs">
                                <div class="comments">
                                    <span>
                                        <i class="fa fa-comments-o"></i>
                                        {{ $ticket->comments()->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                @else
                    <div style="padding: 15px">
                        Unfortunately, we could not find any tickets for you at the moment.
                    </div>
                @endif
            </div>
        </div>
        <center>
            {{ $tickets->render() }}
        </center>
    </div>
@endsection
