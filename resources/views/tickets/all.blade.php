@extends("templates.auth.app")

@section("content")
    <div class="tickets all">
        <div class="row">
            <div class="col-sm-2 sub-toolbar">
                <div class="inner">
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

                    <h6>priority filters</h6>
                    <ul>
                        <li>
                            <a href="">
                                <i class="fa fa-level-down"></i> Low
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-cog"></i> Normal
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-level-up"></i> High
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-warning"></i> Urgent
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-10">
                @if (!empty($tickets))
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
                                        <td>
                                            <a href="{{ route('tickets.show', ['id' => $ticket['id']]) }}">#{{ $ticket['id'] }}</a>
                                        </td>
                                        <td>{{ $ticket['title'] }}</td>
                                        <td>{{ $ticket["department"]["department"] }}</td>
                                        <td><a href="">{{ $ticket['user']['name'] }}</a></td>
                                        <td>{{ $ticket['status']['status'] }}</td>
                                        <td>{{ $ticket['type']['type'] }}</td>
                                        <td>{{ $ticket['created_at'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning" style="margin-top: 25px">
                        Oh no! Unfortunately no tickets could be found by your search.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
