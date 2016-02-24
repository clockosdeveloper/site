@extends('app')

@section('content')
    <div class="alert alert-warning">
        {{trans('alert.not_found')}}
    </div>
    <a href="/">{{trans('app.return_home')}}</a>
@stop