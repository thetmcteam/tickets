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
                            <input type="text" class="form-control" name="query" value="{{ request()->get('query') ?: '' }}">
                            <span class="input-group-btn">
                                <button class="btn btn-success">Filter</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/tickets/create">
                    New Ticket
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Tickets</div>
            <div class="panel-body">
                @if ($tickets->count() > 0)
                    @foreach ($tickets as $ticket)
                        <div class="ticket">
                            <div class="pull-left">
                                <h3>
                                    <span class="status">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    <span class="department">{{ $ticket->department()->first()->department }}</span>
                                    <a href="/tickets/{{ $ticket->id }}">{{ $ticket->title }}</a>

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
                                <h4>#{{ $ticket->id }} opened on May 2nd by <a href="">{{ $ticket->user()->first()->name }}</a></h4>
                            </div>
                            <div class="meta pull-right">
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
