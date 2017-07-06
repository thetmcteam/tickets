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
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="tview">
                        <div class="reply">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="image">
                                        <img src="{{ Auth::user()->image ? Auth::user()->image : 'http://www.mtlwalks.com/images/empty_profile.jpg' }}">
                                    </div>
                                </div>
                                <div class="col-sm-11">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            {{ $ticket['user']['name'] }} opened this ticket {{ \Carbon\Carbon::parse($ticket['created_at'])->diffForHumans() }}
                                        </div>
                                        <div class="panel-body">{!! nl2br($ticket['content']) !!}</div>
                                    </div>
                                    @if (!empty($ticket['actions']))
                                        <ul class="actions">
                                            @foreach ($ticket['actions'] as $action)
                                                <?php $data = json_decode($action['data'], true); ?>

                                                <li class="action">
                                                    <i class="fa fa-bell-o"></i>
                                                    <span class="heading">
                                                        <img src="{{ $action['user']['image'] ? $action['user']['image'] : 'http://www.mtlwalks.com/images/empty_profile.jpg' }}">
                                                        <a class="user">{{ $action['user']['name'] }}</a>
                                                    </span>
                                                    <span class="content">
                                                        @if ($action['action'] === 'priority')
                                                            changed the priority to
                                                        @elseif ($action['action'] === 'status')
                                                            changed the status to
                                                        @elseif ($action['action'] === 'type')
                                                            changed the type to
                                                        @elseif ($action['action'] === 'assignee')
                                                            assigned
                                                        @endif
                                                        <span class="label" style="background-color: {{ $data['color']  }}; margin-right: 4px">
                                                            {{ $data['value'] }}
                                                        </span>
                                                        <timeago since="{{ $action['created_at'] }}"></timeago>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <comments ticket="{{ $ticket['id'] }}"></comments>
                    <comment ticket="{{ $ticket['id'] }}" image="{{ Auth::user()->image }}"></comment>
                </div>
                <div class="col-sm-3">
                    <ticket-meta t="{{ json_encode($ticket) }}"></ticket-meta>
                </div>
            </div>
        </div>
    </div>

    <type ticket="{{ $ticket['id'] }}" type="{{ $ticket['type']['id'] }}"></type>
    <status ticket="{{ $ticket['id'] }}" status="{{ $ticket['status']['id'] }}"></status>
    <assign ticket="{{ $ticket['id'] }}" assignee="{{ $ticket['assignee']['id'] }}"></assign>
    <priority ticket="{{ $ticket['id'] }}" priority="{{ $ticket['priority']['id'] }}"></priority>
@endsection
