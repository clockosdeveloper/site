@extends('app')
@section('content')

    @include('doc.top')

        <div class="panel panel-default col-md-12">
            <div class="panel-body">
                @if(App::getLocale()=='en')
                    @include('doc.navi')
                @else
                    @include('doc.navi_zh')
                @endif
            </div>
        </div>


@stop
