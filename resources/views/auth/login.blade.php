@extends("templates.guest.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-push-4">
                <authenticate></authenticate>
            </div>
        </div>
    </div>
@endsection
