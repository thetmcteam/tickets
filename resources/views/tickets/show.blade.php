@extends("templates.auth.app")

@section("content")
    <div class="row">
        <div class="ticket view">
            <div class="title">
                <h2>
                    {{ $ticket['title'] }}
                    <span style="color: #a3aab1">#{{ $ticket['id'] }}</span>
                </h2>
                <h3>
                    <span class="label" style="background-color: {{ $ticket['status']['color']  }}">
                        <i class="fa fa-warning"></i>
                        {{ $ticket['status']['status'] }}
                    </span>
                    <span>
                        <a href="">{{ $ticket['user']['name'] }}</a>
                        opened this ticket {{ \Carbon\Carbon::parse($ticket['created_at'])->diffForHumans() }}
                    </span>
                </h3>
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
                                        <div class="panel-heading">
                                            {{ $ticket['user']['name'] }} opened this ticket {{ \Carbon\Carbon::parse($ticket['created_at'])->diffForHumans() }}
                                        </div>
                                        <div class="panel-body">{!! nl2br($ticket['content']) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <comments ticket="{{ $ticket['id'] }}"></comments>
                    <comment ticket="{{ $ticket['id'] }}"></comment>
                </div>
                <div class="col-sm-3">
                    <div class="meta">
                        <ul>
                            <li>
                                <span>Department</span>
                                {{ $ticket['department']['department'] }}
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#assignTicketModal"><span>Assignee</span></a>
                                <a href="">{{ $ticket['assignee']['name'] }}</a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#ticketStatusModal"><span>Status</span></a>
                                <p class="label" style="background-color: {{ $ticket['status']['color']  }}">
                                    <i class="fa fa-warning"></i>
                                    {{ $ticket['status']['status'] }}
                                </p>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#ticketPriorityModal"><span>Priority</span></a>
                                <p class="label" style="background-color: {{ $ticket['priority']['color']  }}">
                                    <i class="fa fa-eye"></i>
                                    {{ $ticket['priority']['priority'] }}
                                </p>
                            </li>
                            <li>
                                <span>Type</span>
                                <p class="label" style="background-color: {{ $ticket['type']['color']  }}">
                                    <i class="fa fa-tags"></i>
                                    {{ $ticket['type']['type'] }}
                                </p>
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
