@extends('app')
@section('content')
    <h1>{{trans('finance.sell')}}{{trans('app.stock')}}</h1><br/>
    {{trans('finance.remain')}}:{{$remain}}
    <hr/>
    @include('errors.form')
    {!! Form::open(['action' => 'TradeController@store' ]) !!}

    <div class="form-group">
        {!! Form::label('amount',trans('finance.amount')) !!}
        {!! Form::input('number','amount',null,['class' => 'form-control', 'placeholder'=> trans('decision.integer'),'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('price',trans('finance.price')) !!}&nbsp;&nbsp;&nbsp;<span id="average_price"></span>
        {!! Form::input('text','price',null,['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit(trans('finance.sell'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop

@section('footer')
    <script>
        $(document).ready(function(){
            $('input[name="price"]').on('keyup change',function(){
                var amount = Number($('input[name="amount"]').val());
                var price = Number($(this).val());
                var average = parseFloat(price/amount).toFixed(2);
                $("#average_price").html("{{trans('finance.aver_price')}}:"+average);
            });
        });
    </script>
@endsection