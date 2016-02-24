@extends('app')
@section('content')
    @include('doc.top')
    <div class="panel panel-default col-md-12">
        <div class="panel-body">
            @include('partials.docsearch')
        </div>
    </div>

@stop
