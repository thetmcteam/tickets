@extends("templates.auth.app")

@section("content")
    <div class="dashboard">
        <div class="statistics">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading">
                        <h4 class="pull-left">Dashboard</h4>
                        <a href="" class="pull-right btn btn-success">open ticket</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/price-tag.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">tickets created</span>
                                    <span class="number">{{ (new $ticket)->newQuery()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/chat.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">responses to a ticket</span>
                                    <span class="number">{{ (new $replies)->newQuery()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/rocket.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">closed tickets</span>
                                    <span class="number">{{ (new $ticket)->newQuery()->where('status', 2)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/success.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">open tickets</span>
                                    <span class="number">{{ (new $ticket)->newQuery()->where('status', 1)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/error.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">pending tickets</span>
                                    <span class="number">{{ (new $ticket)->newQuery()->where('status', 3)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statistic">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="image">
                                    <img src="{{ asset('images/warning.png') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="content">
                                    <span class="description">unresolved tickets</span>
                                    <span class="number">{{ (new $ticket)->newQuery()->where('status', 4)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading">
                        <h4>An in-depth look</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chart">
                        <metrics-ticket></metrics-ticket>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="chart">
                        <metrics-department></metrics-department>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
