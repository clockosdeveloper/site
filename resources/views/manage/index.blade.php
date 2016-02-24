@extends('app')
@section('content')
<h1>{{trans('app.manage')}}</h1>
    <hr/>
<ul class="nav nav-tabs" style="margin-bottom: 15px">
    <li role="presentation" class="active"><a href="{{ url('/manage') }}">clockOS</a></li>
    <li role="presentation"><a href="{{ url('/team') }}">{{trans('app.team')}}</a></li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('app.position')}}</h3>
    </div>
    <div class="panel-body">
        @foreach($roles as $item)
        <img src="{{Clockos\Test::cdn($item->logo)}}" class="quest-skill" data-toggle="tooltip" data-placement="bottom" title="{{trans('manage.'.$item->name)}}">
        @endforeach
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('app.permission')}}</h3>
    </div>
    <div class="panel-body"><br/>
        @foreach($permissions as $item)
            @if(\Auth::user()->can($item->name))
                <div class="col-md-4"><a href="{{$item->path}}">{{trans('permission.'.$item->name)}}</a><hr/></div>
            @endif
        @endforeach

            <div class="col-md-12"><a href="/docs/permission/">{{trans('permission.all')}}</a><br/><br/></div>
</div>
</div>
@endsection
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection