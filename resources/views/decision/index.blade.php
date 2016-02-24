@extends('app')
@section('content')
<h1>{{trans('app.decision')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation" class="active"><a href="{{ url('/decision') }}">{{trans('decision.vote')}}</a></li>
        <li role="presentation"><a href="{{ url('/quests/6') }}">{{trans('decision.participate')}}</a></li>
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

                {{trans('decision.type')}}:

                @include('partials.decision_type')

                <br/>
                {{trans('app.level')}}:
                {!! link_to_action('DecisionsController@index', 'Lv.'.\Auth::user()->level, ['level' => '<='.\Auth::user()->level])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Lv.'.\Auth::user()->level.'+', ['level' => '>'.\Auth::user()->level])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Lv.5+', ['level' => '>5'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Lv.10+', ['level' => '>10'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Lv.20+', ['level' => '>20'])!!}
                <br/>
                {{trans('show.state')}}:
                {!! link_to_action('DecisionsController@index', trans('decision.3'), ['state' => 3])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', trans('decision.4'), ['state' => 4])!!}
                <br/>
                {{trans_choice('show.departments',1)}}:
                {!! link_to_action('DecisionsController@index', 'OS', ['department' => 'OS'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Clients', ['department' => 'Clients'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'App Builder', ['department' => 'App Builder'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'API', ['department' => 'API'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Developer', ['department' => 'Developer'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'AI', ['department' => 'AI'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Genetic', ['department' => 'Genetic'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Neural', ['department' => 'Neural'])!!}&nbsp;&middot;
                {!! link_to_action('DecisionsController@index', 'Portal', ['department' => 'Portal'])!!}
                <hr/>
                <a class="btn btn-primary pull-right" href="/decision/create">{{trans('decision.create')}}</a>
            </div>
        </div>
    </div>
    <div id="quests-list">
        @foreach($decisions->all() as $decision)

            <a href="{{action('DecisionsController@show',[$decision->id])}}" class="col-md-6 col-lg-4" id="{{$decision->id}}">
                <div class="panel panel-default">
                    <img src="{{\Clockos\Test::cdn('/img/decisions/'.$decision->type.'.png')}}">
                    <div class="panel-body">
                        <div class="list-first-row">
                            <div class="quests-list-title">{{$decision->title}}</div><div class="quests-type-tag">{{trans('decision.'.$decision->type)}}</div>
                        </div>
                        <div class="quests-list-status">
                            @include('partials.decision_state',['state' => $decision->state])
                            <br/><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;{{trans('decision.greater',['min_vote' => $decision->min_vote])}}
                        </div>
                        <div class="quests-list-bottom">
                            <img src="{{\Clockos\Test::cdn('/img/level.png!35')}}" class="quests-logo" alt="Lv" align="right">

                            @foreach($decision->departments as $item)
                                <img src="{{\Clockos\Test::cdn($item->logo.'!35')}}" class="quests-logo" alt="{{$item->name}}" align="right">
                            @endforeach
                            @foreach($decision->skills as $item)
                                <img src="{{\Clockos\Test::cdn($item->logo.'!35')}}" class="quests-logo" alt="{{$item->name}}" align="right">
                            @endforeach

                            <span class="quests-level">Lv.{{$decision->min_level}}</span>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
    <div class="col-md-12" style="text-align: center">{!! $decisions->appends(Request::except('page'))->render()!!}</div>
@stop
