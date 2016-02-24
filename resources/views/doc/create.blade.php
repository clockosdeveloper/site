@extends('app')
@section('content')
    <h1>{{trans('doc.create')}}</h1>
    <hr/>
    @include('errors.form')
    {!! Form::open(['action' => 'DocsController@store' ]) !!}

        @include('doc.form',['submitButtonText' =>trans('form.submit')])

    {!! Form::close() !!}


@stop