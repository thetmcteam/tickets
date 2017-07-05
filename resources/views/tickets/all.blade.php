@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="panel panel-default">
            <div class="panel-heading">Tickets</div>
            <div class="panel-body">
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
                            <h4>#{{ $ticket->id }} opened on May 2nd by {{ $ticket->user()->first()->name }}</h4>
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
            </div>
        </div>
        <center>
            {{ $tickets->render() }}
        </center>
    </div>
@endsection
