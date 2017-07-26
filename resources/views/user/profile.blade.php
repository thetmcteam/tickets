@extends("templates.auth.app")

@section("content")
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" style="padding: 0">
                    <div class="user">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="heading">
                                    <img src="{{ $user->getImage() }}">
                                    <h4 class="name">
                                        {{ $user->name }}
                                        <small>
                                            {{ $user->isAdmin() ? 'Administrator' : 'Member' }}
                                        </small>
                                    </h4>
                                </div>
                                <ul class="statistics">
                                    <li><i class="fa fa-ticket"></i> tickets created <span class="badge">{{ $user->tickets()->count() }}</span></li>
                                    <li><i class="fa fa-comment-o"></i> replies <span class="badge">{{ $user->replies()->count() }}</span></li>
                                    <li><i class="fa fa-comments-o"></i> notes <span class="badge">{{ $user->notes()->count() }}</span></li>
                                </ul>
                                <ul class="authorizations">
                                    @foreach ($user->authorizations()->get() as $authorization)
                                        <li>{{ ucfirst(strtolower($authorization->department()->first()->department)) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="tickets all">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if (($tickets = $user->tickets()->where('status', 1)->get())->count() > 0)
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
                                                <h4>#{{ $ticket->id }} opened on {{ date('F jS', strtotime($ticket->created_at)) }} by <a href="/tickets/?query={{ $ticket->user()->first()->name }}">{{ $ticket->user()->first()->name }}</a></h4>
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
                                    <div style="padding: 10px">
                                        You don't have any open tickets right now.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
