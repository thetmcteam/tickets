@extends("templates.auth.app")

@section("content")
    <div class="ticket create">
        <div class="tcreate">
            <div class="reply">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="image">
                            <img src="{{ $user->getImage() }}">
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">Update your account information</div>
                            <div class="panel-body">
                                <account id="{{ $user->id }}" name="{{ $user->name }}" image="{{ $user->image }}"></account>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Update your password</div>
                            <div class="panel-body">
                                <password id="{{ $user->id }}"></password>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
