@extends("templates.auth.app")

@section("content")
    <div class="row">
        <div class="navbar navbar-default heading stick-to-top">
            <ul class="nav navbar-nav">
                <li><a href=""><i class="fa fa-plus"></i></a></li>
            </ul>
            <ul class="pager pull-right">
                <li><a href="">last</a></li>
                <li><a href="">next</a></li>
            </ul>
        </div>
        <div class="tickets all">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Department</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>
                                <a href="/tickets/{{ $ticket['id'] }}">#{{ $ticket['id'] }}</a>
                            </td>
                            <td>{{ $ticket['department']['department'] }}</td>
                            <td>{{ $ticket['user']['name'] }}</td>
                            <td>{{ $ticket['title'] }}</td>
                            <td>{{ $ticket['priority']['priority'] }}</td>
                            <td>{{ $ticket['created_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
