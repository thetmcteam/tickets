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
                <hr>
            </div>
            <div class="row">
                <div class="col-sm-9">
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
                                        <div class="panel-body">{!! nl2br($ticket['content']) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <comment ticket="{{ $ticket['id'] }}"></comment>
                    <comments ticket="{{ $ticket['id'] }}"></comments>
                </div>
                <div class="col-sm-3">
                    <div class="meta">
                        <ul>
                            <li>
                                <span>Assignee</span>
                                {{ $ticket['assignee']['name'] }}
                            </li>
                            <li>
                                <span>Status</span>
                                {{ $ticket['status']['status'] }}
                            </li>
                            <li>
                                <span>Type</span>
                                {{ $ticket['type']['type'] }}
                            </li>
                            <li>
                                <span>Department</span>
                                {{ $ticket['department']['department'] }}
                            </li>
                            <li>
                                <span>Priority</span>
                                {{ $ticket['priority']['priority'] }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <status ticket="{{ $ticket['id'] }}" status="{{ $ticket['status']['id'] }}"></status>
    <assign ticket="{{ $ticket['id'] }}" assignee="{{ $ticket['assignee']['id'] }}"></assign>
    <priority ticket="{{ $ticket['id'] }}" priority="{{ $ticket['priority']['id'] }}"></priority>
@endsection
