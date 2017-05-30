@extends("templates.auth.app")

@section("content")
    <div class="tickets show">
        <div class="creator">
            <h3>
                {{ $ticket['title'] }}<br>
                <small>
                    <a href="">{{ $ticket['user']['name'] }}</a>
                    &lt;{{ $ticket['user']['email'] }}&gt;
                </small>
            </h3>
        </div>
        <div class="content">
            {!! nl2br($ticket['content']) !!}
        </div>
        <div class="reply">
            <create-comment ticket="{{ $ticket['id'] }}"></create-comment>
        </div>
        <all-comments ticket="{{ $ticket['id'] }}"></all-comments>
    </div>
@endsection
