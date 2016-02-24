@extends('app')
@section('content')
<h1>{{trans('app.finance')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/finance') }}">{{trans('finance.summary')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/income') }}">{{trans('finance.income')}}</a></li>
        <li role="presentation" class="active"><a href="{{ url('/finance/outcome') }}">{{trans('finance.outcome')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/trade') }}">{{trans('finance.trade')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/invest') }}">{{trans('finance.invest')}}</a></li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.filter',2)}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                {{trans('show.state')}}:
                {!! link_to_action('OutcomesController@index', trans('finance.0'), ['state' => 0])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.2'), ['state' => 2])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.4'), ['state' => 4])!!}
                <br/>
                {{trans('finance.type')}}:
                {!! link_to_action('OutcomesController@index', trans('finance.software'), ['type' => 'software'])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.hardware'), ['type' => 'hardware'])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.service'), ['type' => 'service'])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.salary'), ['type' => 'salary'])!!}&nbsp;&middot;
                {!! link_to_action('OutcomesController@index', trans('finance.other'), ['type' => 'other'])!!}

            </table>
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-primary" href="/finance/outcome/create">{{trans('finance.add_outcome')}}</a>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('finance.outcome_record')}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('finance.title')}}</td>
                    <td>{{trans('finance.provider')}}</td>
                    <td>{{trans('finance.applier')}}</td>
                    <td>{{trans('finance.type')}}</td>
                    <td>{{trans('finance.price')}}</td>
                    <td>{{trans('finance.start')}}</td>
                    <td>{{trans('finance.end')}}</td>
                </tr>
                @foreach($outcome as $item)
                <tr class="
                @if($item->state==0)
                    danger
                @endif
                @if($item->state==2)
                    info
                @endif
                        ">
                    <td><a href="/finance/outcome/{{$item->id}}">{{$item->title}}</a></td>
                    <td>{{$item->provider}}</td>
                    <td><a href="/profiles/{{$item->user->id}}">{{$item->user->username}}</a></td>
                    <td>{{trans('finance.'.$item->type)}}</td>
                    <td>{{Clockos\ChangeRate::toRmb($item->price)}}</td>
                    <td>{{$item->start->format('Y-m-d')}}</td>
                    <td>{{$item->end->format('Y-m-d')}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-12" style="text-align: center">{!! $outcome->appends(Request::except('page'))->render()!!}</div>
    </div>
@endsection
@section('footer')
@endsection