@extends("templates.auth.app")

@section("content")
    <div class="tickets show">
        <div class="row">
            <div class="col-sm-3 sub-toolbar">
                <div class="sticky">
                    <div class="section small-creator">
                        <img src="https://www.webpagefx.com/data/marketing-persona-generator/img/placeholder.png">
                        <h5>{{ $ticket['user']['name'] }}</h5>
                    </div>
                    <div class="section status">
                        <ticket-status ticket="{{ $ticket['id'] }}" status="{{ $ticket['status']['id'] }}"></ticket-status>
                    </div>
                    <div class="section assignees">
                        <ticket-assignee ticket="{{ $ticket['id'] }}" assignee="{{ $ticket['assignee']['id'] }}"></ticket-assignee>
                    </div>
                    <div class="section priority">
                        <ticket-priority ticket="{{ $ticket['id'] }}" priority="{{ $ticket['priority']['id'] }}"></ticket-priority>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
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
                    <div style="clear: both"></div>
                </div>
                <all-comments ticket="{{ $ticket['id'] }}"></all-comments>
            </div>
        </div>
    </div>
@endsection
