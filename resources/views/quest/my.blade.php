@extends('app')
@section('content')
    <h1>{{trans('app.project')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/quests') }}">{{trans_choice('app.quest',2)}}</a></li>
        <li role="presentation"  class="active"><a href="{{ url('/quests/my') }}">{{trans('show.my')}}</a></li>
        <li role="presentation"><a href="{{ url('/docs') }}">{{trans_choice('app.docs',2)}}</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    {{trans_choice('app.filter',3)}}
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                {{trans('form.type')}}:
                {!! link_to_action('MyQuestsController@index', trans('show.created_by'), ['type' => 'user_id'])!!}&nbsp;&middot;
                {!! link_to_action('MyQuestsController@index', trans('show.checked'), ['type' => 'checker_id'])!!}&nbsp;&middot;
                {!! link_to_action('MyQuestsController@index', trans('show.executing'), ['type' => 'execution_id'])!!}&nbsp;&middot;
                {!! link_to_action('MyQuestsController@index', trans('show.final_checked_by'), ['type' => 'final_checker_id'])!!}
                <br/>
                <hr/>

                <a class="btn btn-primary pull-right" href="/quests/create">{{trans('form.create')}}</a>

            </div>
        </div>
    </div>
    <div id="quests-list">
    @foreach($quests->all() as $quest)

        <a href="{{action('QuestsController@show',[$quest->id])}}" class="col-md-6 col-lg-4" id="{{$quest->id}}">
            <div class="panel panel-default">
                <img src="{{\Clockos\Test::cdn('/img/types/'.$quest->type.'.png')}}">
                <div class="panel-body">
                    <div class="list-first-row">
                        <div class="quests-list-title">{{$quest->title}}</div><div class="quests-type-tag">{{trans('form.'.$quest->type)}}</div>
                    </div>
                    <div class="quests-list-status">
                        @include('partials.state',['state' => $quest->state])
                            <br/><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>&nbsp;{{trans_choice('app.stock',$quest->stock)}}:{{$quest->stock}}
                    </div>
                    <div class="quests-list-bottom">
                        <img src="{{\Clockos\Test::cdn('/img/level.png!35')}}" class="quests-logo" alt="Lv" align="right">
                        <img src="{{\Clockos\Test::cdn('/img/'.$quest->difficulty.'.png!35')}}" class="quests-logo" align="right">
                        @foreach($quest->departments as $item)
                            <img src="{{\Clockos\Test::cdn($item->logo.'!35')}}" class="quests-logo" alt="{{$item->name}}" align="right">
                        @endforeach
                        @foreach($quest->skills as $item)
                            <img src="{{\Clockos\Test::cdn($item->logo.'!35')}}" class="quests-logo" alt="{{$item->name}}" align="right">
                        @endforeach

                            <span class="quests-level">Lv.{{$quest->min_level}}</span>
                    </div>
                </div>
            </div>
        </a>

    @endforeach
    </div>
    <div class="col-md-12" style="text-align: center">{!! $quests->appends(Request::except('page'))->render()!!}</div>

@stop

@section('footer')
    <script>

    </script>
@endsection
