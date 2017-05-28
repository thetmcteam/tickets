@extends("templates.auth.app")

@section("content")
    <div class="tickets.create">
        <div class="heading">
            <ul class="breadcrumb">
                <li><a href="{{ route('tickets') }}">Tickets</a></li>
                <li class="disabled">Create</li>
            </ul>
        </div>
        <create-ticket></create-ticket>
    </div>
@endsection
