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
            <form action="" method="post">
                <div class="form-group">
                    <textarea class="form-control" rows="6" placeholder="Post a reply to this ticket..."></textarea>
                </div>
                <button class="btn btn-primary pull-right">reply</button>
                <div style="clear: both"></div>
            </form>
        </div>
        @if (!empty($ticket['comments']))
            <div class="replies">
                @foreach ($ticket['comments'] as $comment)
                    <div class="reply">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="">{{ $comment['user']['name'] }}</a> replied
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment['created_at']))->diffForHumans() }}
                            </div>
                            <div class="panel-body">
                                {!! $comment['content'] !!}
                            </div>
                            @if (!empty($comment['notes']))
                                <ul class="list-group">
                                    @foreach ($comment['notes'] as $note)
                                        <li class="list-group-item">
                                            <a href="">{{ $note['user']['name'] }}</a>
                                            {{ $note['content'] }}
                                            <i>({{ \Carbon\Carbon::createFromTimeStamp(strtotime($note['created_at']))->diffForHumans() }})</i>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="panel-footer">
                                <a><i class="fa fa-reply"></i></a>
                                <a><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
