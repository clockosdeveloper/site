@extends('app')
@section('content')
<h1>{{trans('app.finance')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation" class="active"><a href="{{ url('/finance') }}">{{trans('finance.summary')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/income') }}">{{trans('finance.income')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/outcome') }}">{{trans('finance.outcome')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/trade') }}">{{trans('finance.trade')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/invest') }}">{{trans('finance.invest')}}</a></li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.stock',2)}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('finance.stocks')}}</td><td>{{\Auth::user()->stock}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.percentage')}}</td><td>{{round((\Auth::user()->stock/$status->stock)*100,2)}}%</td>
                </tr>
                <tr>
                    <td>{{trans('finance.rank')}}</td><td>{{\Auth::user()->rank()}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.remain')}}</td><td>{{$remain}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.sold')}}</td><td>{{Clockos\ChangeRate::toRmb(\Auth::user()->sell()->where('state',4)->sum('price'))}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.sold_amount')}}</td><td>{{\Auth::user()->sell()->where('state',4)->sum('amount')}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.purchased')}}</td><td>{{Clockos\ChangeRate::toRmb(\Auth::user()->purchase()->where('state',4)->sum('price'))}}</td>
                </tr>
                <tr>
                    <td>{{trans('finance.purchased_amount')}}</td><td>{{\Auth::user()->purchase()->where('state',4)->sum('amount')}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
@section('footer')
@endsection