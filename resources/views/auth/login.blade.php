@extends("templates.guest.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                <authenticate></authenticate>
            </div>
        </div>
    </div>
@endsection
