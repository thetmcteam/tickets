@extends("templates.auth.app")

@section("content")
    <div class="row">
        <div class="navbar navbar-default heading stick-to-top">
            <ul class="nav navbar-nav">
                <li><a href="">assign</a></li>
                <li><a href="">status</a></li>
                <li><a href="">priority</a></li>
                <li><a href="">type</a></li>
                <li><a href="">comment</a></li>
            </ul>
        </div>
        <div class="ticket view">
            <div class="title">
                <h1><img src="http://www.mtlwalks.com/images/empty_profile.jpg"> {{ $ticket['title'] }}</h1>
                <ul class="meta">
                    <li>
                        <i class="fa fa-user"></i>
                        {{ $ticket['user']['name'] }}
                    </li>
                    <li>
                        <i class="fa fa-users"></i>
                        {{ $ticket['assignee']['name'] }}
                    </li>
                    <li>
                        <i class="fa fa-cog"></i>
                        {{ $ticket['status']['status'] }}
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        {{ $ticket['department']['department'] }}
                    </li>
                    <li>
                        <i class="fa fa-warning"></i>
                        {{ $ticket['priority']['priority'] }}
                    </li>
                </ul>
            </div>
            <div class="body">
                {!! nl2br($ticket['content']) !!}
            </div>
            
            <comment ticket="{{ $ticket['id'] }}"></comment>
            <comments ticket="{{ $ticket['id'] }}"></comments>
        </div>
    </div>

    @if (Auth::user()->id === $ticket['assignee']['id'])
        <div class="assigned--to--you">
            <i class="fa fa-user"></i>
            This ticket is assigned to you.
        </div>
    @endif
@endsection
