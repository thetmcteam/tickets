@extends("templates.guest.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                <div class="auth--heading text-center">
                    <h3>helpdesk</h3>
                </div>
                <authenticate></authenticate>
            </div>
        </div>
    </div>
@endsection
