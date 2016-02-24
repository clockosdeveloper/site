@extends('app')
@section('content')
    <h1>{{trans('app.status')}}</h1><hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/status') }}">{{trans('status.now')}}</a></li>
        <li role="presentation" class="active"><a href="{{ url('/status/weekly') }}">{{trans('status.weekly')}}</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.stock',2)}}</div>
        <div class="panel-body">
            <div class="col-md-12" style="text-align: center">
                <canvas width="1000" height="500" id="status-stock" style="display: inline"></canvas>
            </div>
            <br/>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>{{trans('status.date')}}</th>
                        <th>{{trans('status.total')}}</th>
                        <th style="color: #10C0FF">{{trans('status.increment')}}</th>
                        <th style="color: #FFC870">{{trans('status.compare')}}</th>
                        <th> </th>
                    </tr>

                    @foreach($status as $item)
                    <tr>
                        <td>{{trans('status.week',['week' => $item->updated_at->weekOfYear,'year' => $item->updated_at->year])}}</td>
                        <td>{{$item->stock}}</td>
                        <td>{{$item->stock_d}}</td>
                        <td>{{$item->stock_dd}}</td>
                        <td>@include('partials.vary',['vary' => $item->stock_dd])</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.quest',2)}}</div>
        <div class="panel-body">
            <div class="col-md-12" style="text-align: center">
                <canvas width="1000" height="500" id="status-quest" style="display: inline"></canvas>
            </div>
            <br/>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>{{trans('status.date')}}</th>
                        <th>{{trans('status.total')}}</th>
                        <th style="color: #10C0FF">{{trans('status.increment')}}</th>
                        <th style="color: #FFC870">{{trans('status.compare')}}</th>
                        <th> </th>
                    </tr>

                    @foreach($status as $item)
                        <tr>
                            <td>{{trans('status.week',['week' => $item->updated_at->weekOfYear,'year' => $item->updated_at->year])}}</td>
                            <td>{{$item->quests_done}}</td>
                            <td>{{$item->quests_done_d}}</td>
                            <td>{{$item->quests_done_dd}}</td>
                            <td>@include('partials.vary',['vary' => $item->quests_done_dd])</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('finance.outcome')}}</div>
        <div class="panel-body">
            <div class="col-md-12" style="text-align: center">
                <canvas width="1000" height="500" id="status-outcome" style="display: inline"></canvas>
            </div>
            <br/>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>{{trans('status.date')}}</th>
                        <th>{{trans('status.total')}}</th>
                        <th style="color: #10C0FF">{{trans('status.increment')}}</th>
                        <th style="color: #FFC870">{{trans('status.compare')}}</th>
                        <th> </th>
                    </tr>

                    @foreach($status as $item)
                        <tr>
                            <td>{{trans('status.week',['week' => $item->updated_at->weekOfYear,'year' => $item->updated_at->year])}}</td>
                            <td>{{$item->outcome}}</td>
                            <td>{{$item->outcome_d}}</td>
                            <td>{{$item->outcome_dd}}</td>
                            <td>@include('partials.vary',['vary' => $item->outcome_dd])</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script src="https://cdn.bootcss.com/Chart.js/1.0.2/Chart.min.js"></script>
<script>
(function () {
    var ctx = document.getElementById('status-stock').getContext('2d');
    var ctx2 = document.getElementById('status-quest').getContext('2d');
    var ctx3 = document.getElementById('status-outcome').getContext('2d');
    var date = [];
    var stock_d = [];
    var stock_dd = [];
    var quests_done_d = [];
    var quests_done_dd = [];
    var outcome_d = [];
    var outcome_dd = [];
    @foreach($status as $item)
        date.push("{{$item->updated_at->weekOfYear}}")
        stock_dd.push("{{$item->stock_dd}}")
        stock_d.push("{{$item->stock_d}}")
        quests_done_dd.push("{{$item->quests_done_dd}}")
        quests_done_d.push("{{$item->quests_done_d}}")
        outcome_dd.push("{{$item->outcome_dd}}")
        outcome_d.push("{{$item->outcome_d}}")
    @endforeach

    var options = {

            };
    var data = {
        labels: date.reverse(),
        datasets: [
            {
                label: "inc",
                fillColor: "rgba(0,220,255,0.2)",
                strokeColor: "#00B0FF",
                pointColor: "#00B0FF",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: stock_d.reverse()
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(255,187,105,0)",
                strokeColor: "#FFC870",
                pointColor: "#FFC870",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: stock_dd.reverse()
            }
        ]
    };
    new Chart(ctx).Line(data, options);

    var data2 = {
        labels: date.reverse(),
        datasets: [
            {
                label: "inc",
                fillColor: "rgba(0,220,255,0.2)",
                strokeColor: "#00B0FF",
                pointColor: "#00B0FF",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: quests_done_d.reverse()
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(255,187,105,0)",
                strokeColor: "#FFC870",
                pointColor: "#FFC870",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: quests_done_dd.reverse()
            }
        ]
    };
    new Chart(ctx2).Line(data2, options);

    var data3 = {
        labels: date.reverse(),
        datasets: [
            {
                label: "inc",
                fillColor: "rgba(0,220,255,0.2)",
                strokeColor: "#00B0FF",
                pointColor: "#00B0FF",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: outcome_d.reverse()
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(255,187,105,0)",
                strokeColor: "#FFC870",
                pointColor: "#FFC870",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: outcome_dd.reverse()
            }
        ]
    };
    new Chart(ctx3).Line(data3, options);
})();
</script>
@endsection