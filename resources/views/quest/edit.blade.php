@extends('app')

@section('content')
    <h1>{{trans('show.change')}}{{trans_choice('app.quest',1)}}</h1>
    @include('errors.form')
    {!! Form::model($quest,['method' => 'PATCH', 'action' => ['QuestsController@update', $quest->id ]]) !!}

    @include('quest.form',['submitButtonText' => trans('form.change')])

    {!! Form::close() !!}

@stop