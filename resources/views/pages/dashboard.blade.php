@extends("templates.auth.app")

@section("content")
    <div class="dashboard">
        <div class="row">
            <div class="col-sm-12">
                <p class="welcome">
                    <b>Hello {{ Auth::user()->name }}</b>, Welcome to your Dashboard.
                    <a class="pull-right">
                        View Open Tickets
                    </a>
                </p>
            </div>
        </div>
        <div class="statistics row">
            <div class="col-sm-3">
                <div class="statistic">
                    <div class="image" style="border: 3px solid #2ecc71">
                        <i class="fa fa-users" style="color: #2ecc71"></i>
                    </div>
                    <h4 class="content"><span class="number">54</span> Users Created</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="statistic">
                    <div class="image" style="border: 3px solid #e74c3c">
                        <i class="fa fa-ticket" style="color: #e74c3c"></i>
                    </div>
                    <h4 class="content"><span class="number">112</span> Tickets Created</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="statistic">
                    <div class="image" style="border: 3px solid #3498db">
                        <i class="fa fa-comments-o" style="color: #3498db"></i>
                    </div>
                    <h4 class="content"><span class="number">543</span> Comments Created</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="statistic">
                    <div class="image" style="border: 3px solid #e67e22">
                        <i class="fa fa-pencil" style="color: #e67e22"></i>
                    </div>
                    <h4 class="content"><span class="number">14235</span> Notes Created</h4>
                </div>
            </div>
        </div>
    </div>
@endsection