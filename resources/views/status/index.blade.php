@extends('app')
@section('content')
    <h1>{{trans('app.status')}}</h1><hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation" class="active"><a href="{{ url('/status') }}">{{trans('status.now')}}</a></li>
        <li role="presentation"><a href="{{ url('/status/weekly') }}">{{trans('status.weekly')}}</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">clockOS</div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>{{trans('app.finance')}}</th><th>{{trans('status.data')}}</th>
                        </tr>
                        <tr>
                            <td style="color: #46BFBD">{{trans('status.stock')}}</td><td>{{$status->stock}}</td>
                        </tr>
                        <tr>
                            <td style="color: #FDB45C">{{trans('status.stock_wait')}}</td><td>{{$status->stock_wait}}</td>
                        </tr>
                        <tr>
                            <td>{{trans('status.per_stock')}}</td><td>{{$status->per_stock}}%</td>
                        </tr>
                        <tr>
                            <td>{{trans('status.average_price')}}</td><td>{{Clockos\ChangeRate::toRmb($status->average_price)}}</td>
                        </tr>
                        <tr>
                            <td>{{trans('status.invested')}}</td><td>{{$status->invested}}</td>
                        </tr>
                        <tr>
                            <td>{{trans('status.outcome')}}</td><td>{{Clockos\ChangeRate::toRmb($status->outcome)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6" style="text-align: center">
                    <canvas width="250" height="250" id="status-stock" style="display: inline"></canvas>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-6" style="text-align: center">
                    <canvas width="400" height="250" id="status-quest" style="display: inline"></canvas>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>{{trans('app.project')}}</th><th>{{trans('status.data')}}</th>
                        </tr>
                        <tr>
                            <td>{{trans('status.quests_done')}}</td><td>{{$status->quests_done}}</td>
                        </tr>
                        <tr>
                            <td style="color:#FDB45C">{{trans('status.quests_doing')}}</td><td>{{$status->quests_doing}}</td>
                        </tr>
                        <tr>
                            <td style="color:#00B0FF">{{trans('status.quests_open')}}</td><td>{{$status->quests_open}}</td>
                        </tr>
                        <tr>
                            <td style="color:#673AB7">{{trans('status.quests_wait')}}</td><td>{{$status->quests_wait}}</td>
                        </tr>
                        <tr>
                            <td>{{trans('status.quests_all')}}</td><td>{{$status->quests_all}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script src="https://cdn.bootcss.com/Chart.js/1.0.2/Chart.min.js"></script>
<script>
    (function () {
        var ctx = document.getElementById('status-stock').getContext('2d');
        var options = {

        };
        var data = [
            {
                value: {{$status->stock}},
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "{{trans('status.stock')}}"
            },
            {
                value: {{$status->stock_wait}},
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "{{trans('status.stock_wait')}}"
            }
        ]
        new Chart(ctx).Doughnut(data,options);

        var ctx2 = document.getElementById('status-quest').getContext('2d');
        var options2 = {

        };
        var data2 = {

            labels:["{{trans('status.quests_wait')}}","{{trans('status.quests_open')}}","{{trans('status.quests_doing')}}"],
            datasets: [
                {
                    fillColor: "#00B0FF",
                    highlightFill: "#10C0FF",
                    label: "",
                    data: [{{$status->quests_wait}},{{$status->quests_open}},{{$status->quests_doing}}]
                }]

        }
        new Chart(ctx2).Bar(data2,options2);
    })();
</script>
@endsection