@extends("templates.guest.app")

@section("content")
    <div class="alert alert-warning" style="border-radius: 0">
        The token associated with this invite will expire 24 hours from when it was sent.
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                <div class="auth--heading text-center">
                    <h3>helpdesk</h3>
                </div>
                <invite invite="{{ $invite }}"></invite>
            </div>
        </div>
    </div>
@endsection
