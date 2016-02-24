@extends('app')
@section('content')
<h1>{{trans('app.finance')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/finance') }}">{{trans('finance.summary')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/income') }}">{{trans('finance.income')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/outcome') }}">{{trans('finance.outcome')}}</a></li>
        <li role="presentation" class="active"><a href="{{ url('/finance/trade') }}">{{trans('finance.trade')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/invest') }}">{{trans('finance.invest')}}</a></li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('finance.statics')}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('status.stock_trade')}}</td>
                    <td>{{Clockos\ChangeRate::toRmb($status->stock_trade)}}</td>
                </tr>
                <tr>
                    <td>{{trans('status.average_price')}}</td>
                    <td>{{Clockos\ChangeRate::toRmb($status->average_price)}}</td>
                </tr>
            </table>
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-primary" href="/finance/trade/purchase">{{trans('finance.buy')}}{{trans_choice('app.stock',2)}}</a>
                <a class="btn btn-primary" href="/finance/trade/create">{{trans('finance.sell')}}{{trans_choice('app.stock',2)}}</a>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans('finance.record')}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('finance.trade_date')}}</td>
                    <td>{{trans('finance.seller')}}</td>
                    <td>{{trans('finance.buyer')}}</td>
                    <td>{{trans('finance.price')}}</td>
                    <td>{{trans('finance.amount')}}</td>
                    <td>{{trans('finance.aver_price')}}</td>
                </tr>
                @foreach($trade as $item)
                <tr>
                    <td>{{$item->updated_at->format('Y-m-d')}}</td>
                    <td><a href="/profiles/{{$item->seller->id}}">{{$item->seller->username}}</a></td>
                    <td><a href="/profiles/{{$item->buyer->id}}">{{$item->buyer->username}}</a></td>
                    <td>{{Clockos\ChangeRate::toRmb($item->price)}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{Clockos\ChangeRate::toRmb($item->average)}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-12" style="text-align: center">{!! $trade->appends(Request::except('page'))->render()!!}</div>
    </div>
@endsection
@section('footer')
@endsection