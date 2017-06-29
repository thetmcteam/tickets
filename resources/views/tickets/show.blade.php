@extends("templates.auth.app")

@section("content")
    <div class="row">
        <div class="navbar navbar-default heading stick-to-top">
            <ul class="nav navbar-nav">
                <li><a data-toggle="modal" data-target="#assignTicketModal">assign</a></li>
                <li><a data-toggle="modal" data-target="#ticketStatusModal">status</a></li>
                <li><a data-toggle="modal" data-target="#ticketPriorityModal">priority</a></li>
                <li><a href="">type</a></li>
            </ul>
        </div>
        <div class="ticket view">
             <div class="title">
                <h2>{{ $ticket['title'] }}</h2>
                <ul class="meta">
                    <li>
                        <i class="fa fa-users" data-toggle="tooltip" data-placement="bottom" title="Assignee"></i>
                        {{ $ticket['assignee']['name'] }}
                    </li>
                    <li>
                        <i class="fa fa-cog" data-toggle="tooltip" data-placement="bottom" title="Status"></i>
                        {{ $ticket['status']['status'] }}
                    </li>
                    <li>
                        <i class="fa fa-home" data-toggle="tooltip" data-placement="bottom" title="Department"></i>
                        {{ $ticket['department']['department'] }}
                    </li>
                    <li>
                        <i class="fa fa-warning" data-toggle="tooltip" data-placement="bottom" title="Priority"></i>
                        {{ $ticket['priority']['priority'] }}
                    </li>
                </ul>
            </div>

            <div class="tview">
                <div class="reply">
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="image">
                                <img src="http://www.mtlwalks.com/images/empty_profile.jpg">
                            </div>
                        </div>
                        <div class="col-sm-11">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{ $ticket['user']['name'] }} opened this ticket {{ \Carbon\Carbon::parse($ticket['created_at'])->diffForHumans() }}</div>
                                <div class="panel-body">
                                    {!! nl2br($ticket['content']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <comment ticket="{{ $ticket['id'] }}"></comment>
            <comments ticket="{{ $ticket['id'] }}"></comments>
        </div>
    </div>

    <status ticket="{{ $ticket['id'] }}" status="{{ $ticket['status']['id'] }}"></status>
    <assign ticket="{{ $ticket['id'] }}" assignee="{{ $ticket['assignee']['id'] }}"></assign>
    <priority ticket="{{ $ticket['id'] }}" priority="{{ $ticket['priority']['id'] }}"></priority>
@endsection
