@extends('app')

@section('content')
    <h1>{{trans('show.change')}}{{trans_choice('app.docs',1)}}</h1>
    @include('errors.form')
    {!! Form::model($doc,['method' => 'PATCH', 'action' => ['DocsController@update', $doc->id ]]) !!}

    @include('doc.form',['submitButtonText' => trans('form.change')])

    {!! Form::close() !!}

@stop