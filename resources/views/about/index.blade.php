@extends('app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ \Clockos\Test::cdn('/css/login.css') }}">
@endsection
@section('content')
    <h2 style="text-align: center">clockOS第一篇章: 走出矿山</h2>
    <br/>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{Clockos\Test::cdn('/vid/poverty.mp4')}}"></iframe>
    </div>
@stop
