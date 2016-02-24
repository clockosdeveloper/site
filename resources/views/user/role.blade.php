@extends('app')
@section('content')
@include('partials.profiles')
    <h1>{{trans('app.role')}}</h1>
    Level.{{\Auth::user()->level}}
<hr/>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('app.position')}}&middot;{{trans('manage.'.$roles->name)}}</h3>
    </div>
    <div class="panel-body">

            <img src="{{Clockos\Test::cdn($roles->logo)}}" class="quest-skill" data-toggle="tooltip" data-placement="bottom" title="{{trans('manage.'.$roles->name)}}">

    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('show.skills')}}</h3>
    </div>
    <div class="panel-body">
        @foreach($skills as $skill)
            <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$skill->fullname}}">
                <div><img src="{{\Clockos\Test::cdn($skill->logo)}}" alt="{{$skill->name}}" class="quest-skill"></div>
            </a>
        @endforeach
        @if(\Auth::user()->level<5)
        Lv.5以上可以再添加一个技能
        @endif
    </div>
</div>
@stop

@section('footer')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
