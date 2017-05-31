@extends("templates.auth.app")

@section("content")
    <div class="tickets show">
        <div class="row">
            <div class="col-sm-2 sub-toolbar">
                <div class="sticky">
                    <div class="section small-creator">
                        <img src="https://www.webpagefx.com/data/marketing-persona-generator/img/placeholder.png">
                        <h5>{{ $ticket['user']['name'] }}</h5>
                    </div>
                    <div class="section viewers">
                        <h6>active users</h6>
                        <ul>
                            <li><i class="fa fa-circle"></i> Jordan Bardsley</li>
                            <li><i class="fa fa-circle"></i> James Andrews</li>
                            <li><i class="fa fa-circle"></i> Tyson Chavarie</li>
                            <li><i class="fa fa-circle"></i> Joe Yates</li>
                        </ul>
                    </div>
                    <div class="section status">
                        <h6>ticket status</h6>
                        <h5><i class="fa fa-clock-o"></i> Awaiting Response</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
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
