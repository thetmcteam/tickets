@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="row">
            <div class="col-sm-2 sub-toolbar">
                <h6>status filters</h6>
                <ul>
                    <li class="active">
                        <a href="">
                            <i class="fa fa-ticket"></i> Everything
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-flag"></i> Open
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-clock-o"></i> Awaiting Response
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-check"></i> Closed
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-search"></i> Monitor
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-10">
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
                                    <td><a href="{{ route('tickets.show', ['id' => $ticket['id']]) }}">#{{ $ticket['id'] }}</a></td>
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
        </div>
    </div>
@endsection
