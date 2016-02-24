@extends('app')
@section('content')
<h1>{{$notification->title}}</h1>
<h5>{{ $notification->updated_at }}</h5>
    <article>{{$notification->body}}</article>
@stop