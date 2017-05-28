@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="heading">
            <ul class="breadcrumb">
                <li><a href="">Tickets</a></li>
                <li class="disabled">All</li>
            </ul>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Department</th>
                        <th>Creator</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td><a href="">#{{ $ticket['id'] }}</a></td>
                            <td>{{ $ticket['title'] }}</td>
                            <td>
                                <i class="fa fa-square" style="color: {{ $ticket['department']['color']  }}"></i>
                                {{ $ticket["department"]["department"] }}
                            </td>
                            <td><a href="">{{ $ticket['user']['name'] }}</a></td>
                            <td>{{ $ticket['status']['status'] }}</td>
                            <td>{{ $ticket['type']['type'] }}</td>
                            <td>{{ $ticket['created_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
