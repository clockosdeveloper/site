@extends('app')
@section('content')
    <h1>{{trans('show.execute')}}</h1>
    <hr/>
    <div class="panel panel-default">
        <div class="panel-body">
            {{trans_choice('show.complete',$quest->days,['days' => $quest->days])}}<br/>
            {{trans('show.earn',['stock' => $quest->stock])}}
        </div>
    </div>
    @include('errors.form')
    {!! Form::model($quest,['method' => 'POST', 'action' => ['ExecuteQuestsController@store']]) !!}
        <input type="hidden" value="{{$quest->id}}" name="id" required>
    {!! Form::submit(trans('app.ok'), ['class' => 'btn btn-primary form-control']) !!}
    {!! Form::close() !!}
@stop
