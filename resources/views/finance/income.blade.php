@extends('app')
@section('content')
<h1>{{trans('app.finance')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/finance') }}">{{trans('finance.summary')}}</a></li>
        <li role="presentation" class="active"><a href="{{ url('/finance/income') }}">{{trans('finance.income')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/outcome') }}">{{trans('finance.outcome')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/trade') }}">{{trans('finance.trade')}}</a></li>
        <li role="presentation"><a href="{{ url('/finance/invest') }}">{{trans('finance.invest')}}</a></li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.stock',2)}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('finance.accomplishment')}}</td>
                    <td>{{trans('finance.date')}}</td>
                    <td>{{trans('app.stock')}}</td>
                    <td>{{trans('finance.type')}}</td>
                    <td>{{trans('finance.per_stock')}}</td>
                </tr>
                @foreach($income as $item)
                <tr>
                    <td><a href="
                    @if(($item->type == 'create_task') OR ($item->type == 'complete_task'))
                    /quests/{{$item->subject_id}}
                    @endif
                    ">{{$item->title}}</a></td>
                    <td>{{$item->created_at->format('Y-m-d')}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{trans('finance.'.$item->type)}}</td>
                    <td>{{$item->per_stock}}%</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.cash',1)}}</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>{{trans('finance.accomplishment')}}</td>
                    <td>{{trans('finance.date')}}</td>
                    <td>{{trans_choice('app.cash',2)}}</td>
                    <td>{{trans('finance.type')}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
@section('footer')
@endsection