@extends("templates.auth.app")

@section("content")
    <div class="row">
        <div class="navbar navbar-default heading stick-to-top">
            <ul class="nav navbar-nav">
                <li><a href="">assign</a></li>
                <li><a href="">status</a></li>
                <li><a href="">priority</a></li>
                <li><a href="">type</a></li>
            </ul>
        </div>
        <div class="ticket view">
            <div class="title">
                <h1><img src="http://www.mtlwalks.com/images/empty_profile.jpg"> {{ $ticket['title'] }}</h1>
                <ul class="meta">
                    <li>
                        <i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="Creator"></i>
                        {{ $ticket['user']['name'] }}
                    </li>
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
            <div class="body">
                {!! nl2br($ticket['content']) !!}
            </div>
            
            <comment ticket="{{ $ticket['id'] }}"></comment>
            <comments ticket="{{ $ticket['id'] }}"></comments>
        </div>
    </div>
@endsection
