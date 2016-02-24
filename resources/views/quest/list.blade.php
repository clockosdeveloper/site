@extends('app')
@section('content')
    <h1>{{trans('app.project')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation" class="active"><a href="{{ url('/quests') }}">{{trans_choice('app.quest',2)}}</a></li>
        <li role="presentation"><a href="{{ url('/quests/my') }}">{{trans('show.my')}}</a></li>
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
                {{trans('show.difficulty')}}:
                {!! link_to_action('QuestsController@index', trans('show.1'), ['difficulty' => 1],['class' => 'text-success'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('show.2'), ['difficulty' => 2],['class' => 'text-primary'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('show.3'), ['difficulty' => 3],['class' => 'text-info'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('show.4'), ['difficulty' => 4],['class' => 'text-warning'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('show.5'), ['difficulty' => 5],['class' => 'text-danger'])!!}<br/>

                {{trans('form.type')}}:

                @include('partials.type')

                <br/>
                {{trans('app.level')}}:
                {!! link_to_action('QuestsController@index', 'Lv.'.\Auth::user()->level, ['level' => '<='.\Auth::user()->level])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Lv.'.\Auth::user()->level.'+', ['level' => '>'.\Auth::user()->level])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Lv.5+', ['level' => '>5'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Lv.10+', ['level' => '>10'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Lv.20+', ['level' => '>20'])!!}
                <br/>
                {{trans('show.state')}}:
                {!! link_to_action('QuestsController@index', trans('form.0'), ['state' => 0])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('form.1'), ['state' => 1])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('form.2'), ['state' => 2])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('form.3'), ['state' => 3])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', trans('form.4'), ['state' => 4])!!}
                <br/>
                {{trans_choice('show.departments',1)}}:
                {!! link_to_action('QuestsController@index', 'OS', ['department' => 'OS'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Clients', ['department' => 'Clients'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'App Builder', ['department' => 'App Builder'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'API', ['department' => 'API'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Developer', ['department' => 'Developer'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'AI', ['department' => 'AI'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Genetic', ['department' => 'Genetic'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Neural', ['department' => 'Neural'])!!}&nbsp;&middot;
                {!! link_to_action('QuestsController@index', 'Portal', ['department' => 'Portal'])!!}
                <hr/>
                <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-primary" href="/quests/?recommend">{{trans('show.recommend')}}</a>
                <a class="btn btn-primary" href="/quests/create">{{trans('form.create')}}</a>
                </div>
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
                        @include('partials.state',['state'=>$quest->state])
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
