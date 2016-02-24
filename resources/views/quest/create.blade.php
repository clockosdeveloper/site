@extends('app')
@section('content')
    <h1>{{trans('form.create')}}</h1>
    <hr/>
    @include('errors.form')
    {!! Form::open(['action' => 'QuestsController@store' ]) !!}

        @include('quest.form',['submitButtonText' =>trans('form.submit')])

    {!! Form::close() !!}

    <a href="/docs/task">{{trans('form.task_doc')}}</a><br/>
@stop