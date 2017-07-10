@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="panel panel-default">
            <div class="panel-heading">Tickets assigned to you</div>
            <div class="panel-body">
                @if ($tickets->count() > 0)
                    @foreach ($tickets as $ticket)
                        <div class="ticket">
                            <div class="pull-left">
                                <h3>
                                    <span class="status">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    <a class="department" href="/tickets?query={{ $ticket->department()->first()->department }}">
                                        {{ $ticket->department()->first()->department }}
                                    </a>
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
                        Looks like you don't have any tickets assigned to you.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
