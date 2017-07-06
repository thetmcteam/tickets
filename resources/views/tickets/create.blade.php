@extends("templates.auth.app")

@section("content")
    <div class="ticket create">
        <h3>Open a new ticket</h3>
        <h3 class="no-margin-top"><small>Please describe your issue in as much detail as possible.</small></h3>
        <hr>

        <div class="tcreate">
            <div class="reply">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="image">
                            <img src="{{ Auth::user()->image ? Auth::user()->image : 'http://www.mtlwalks.com/images/empty_profile.jpg' }}">
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">This ticket will be opened under your name</div>
                            <div class="panel-body">
                                <create-ticket></create-ticket>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
