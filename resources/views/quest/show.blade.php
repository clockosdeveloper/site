@extends('app')
@section('stylesheet')
<style type="text/css">
.quest-type{
    position: absolute;
    right:18px;
    bottom: 0;
    text-align: right;
    color: white;
    text-shadow: rgba(0,0,09, 0.5) 1px 1px 6px;
    font-size: 18px;
}
.quest-level{
    position: absolute;
    left: 2px;
    color: #FFF;
    top: 18px;
    text-align: center;
    width: 50px;
}
.quest-title{
    word-wrap: break-word;
}
.quests-prerequisite td{
    border-top: none!important;
}
.btn-group-justified{
    margin-bottom: 20px;
}
.quest-skill{
    height:50px!important;
    width:50px!important;
}
</style>
<link href="https://cdn.bootcss.com/highlight.js/9.1.0/styles/tomorrow-night.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="col-md-8">
            <h3 class="quest-title">{{$quest->title}}</h3><br/>
            @include('partials.state',['state' => $quest->state])
            <br/>

            <br/>
            <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{trans('app.level')}}:{{$quest->min_level}}">
                <div style="position: relative"><img src="{{\Clockos\Test::cdn('/img/level.png!75')}}" alt="Level" class="quest-skill">
                    <span class="quest-level">Lv.{{$quest->min_level}}</span>
                </div>
            </a>
            <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{trans('show.difficulty')}}:{{trans('show.'.$quest->difficulty)}}">
                <div><img src="{{\Clockos\Test::cdn('/img/'.$quest->difficulty.'.png!75')}}" alt="Level" class="quest-skill"></div>
            </a>
            @foreach($quest->departments as $skill)
                <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$skill->fullname}}">
                    <div><img src="{{\Clockos\Test::cdn($skill->logo.'!75')}}" alt="{{$skill->name}}" class="quest-skill"></div>
                </a>
            @endforeach
            @foreach($quest->skills as $skill)
                <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$skill->fullname}}">
                    <div><img src="{{\Clockos\Test::cdn($skill->logo.'!75')}}" alt="{{$skill->name}}" class="quest-skill"></div>
                </a>
            @endforeach
        </div>
        <div class="col-md-4">
            <img src="{{\Clockos\Test::cdn('/img/types/'.$quest->type.'.png')}}">
            <span class="quest-type" style="">{{trans('form.'.$quest->type)}}</span>
        </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('show.basic')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table quests-prerequisite">
                <tr>
                    <td>{{trans('app.level')}}</td>
                    <td>{{$quest->min_level}}</td>
                </tr>
                <tr>
                    <td>{{trans('show.difficulty')}}</td>
                    <td>{{trans('show.'.$quest->difficulty)}}</td>
                </tr>
                <tr>
                    <td>{{trans('show.creator')}}</td>
                    <td><a href="{{action('ProfilesController@show',[$quest->user->id])}}">{{$quest->user->username}}</a></td>
                </tr>
                <tr>
                    <td>{{trans('show.created')}}</td>
                    <td>{{$quest->created_at->diffForHumans()}}</td>
                </tr>
                @if($quest->state>0)
                    <tr>
                        <td>{{trans('show.checker')}}</td>
                        <td><a href="{{action('ProfilesController@show',[$quest->checker->id])}}">{{$quest->checker->username}}</a></td>
                    </tr>
                @endif
                @if($quest->state>2)
                <tr>
                    <td>{{trans('show.executor')}}</td>
                    <td><a href="{{action('ProfilesController@show',[$quest->executor->id])}}">{{$quest->executor->username}}</a></td>
                </tr>
                <tr>
                    <td>{{trans('show.executed')}}</td>
                    <td>{{$quest->created_at->diffForHumans()}}</td>
                </tr>
                @endif
                @if($quest->state==3)
                    <tr>
                        <td>{{trans('show.estimated')}}</td>
                        <td>{{$quest->estimated->diffForHumans()}}</td>
                    </tr>
                @endif
                @if($quest->state==4)
                    <tr>
                        <td>{{trans('show.final_checker')}}</td>
                        <td><a href="{{action('ProfilesController@show',[$quest->final_checker->id])}}">{{$quest->final_checker->username}}</a></td>
                    </tr>
                    <tr>
                        <td>{{trans('show.completed')}}</td>
                        <td>{{$quest->completed->diffForHumans()}}</td>
                    </tr>
                @endif
                <tr>
                    <td>{{trans_choice('app.stock',$quest->stock)}}</td>
                    <td>{{$quest->stock}}</td>
                </tr>
                <tr>
                    <td>{{trans('form.departments')}}</td>
                    <td>
                        @foreach($quest->departments as $item)
                            {{$item->name}}&nbsp;
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>{{trans('form.skills')}}</td>
                    <td>
                        @foreach($quest->skills as $item)
                            {{$item->name}}&nbsp;
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @if($quest->quests->count()>0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('form.quests')}}</h3>
        </div>
        <div class="panel-body">
    <table class="table quests-prerequisite">
        @foreach($quest->quests as $item)

            <tr>
                <td><a href="{{action('QuestsController@show', ['id' => $item->id])}}" target="_blank">{{$item->title}}</a></td>
                <td>{{trans('form.'.$item->type)}}</td>
                <td>
                    @include('partials.state',['state' => $item->state])
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    </div>
    @endif



    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('form.details')}}</h3>
        </div>
        <div class="panel-body">

            @can('min_level',$quest)
            <div class="quests-markdown">{!! $quest->body !!}</div>
            @endcan
            @cannot('min_level',$quest)
            <span class="bg-warning text-warning">{{trans('show.min_level',['level' =>$quest->min_level])}}</span>
            @endcan
        </div>
    </div>

<div class="btn-group btn-group-justified col-lg-6" role="group" aria-label="...">
    @can('update',$quest)
        @if($quest->state==0)
            <a class="btn btn-primary" href="{{action('QuestsController@edit',[$quest->id])}}">{{trans('show.change')}}</a>
            <a class="btn btn-danger" data-token="{{csrf_token()}}" href="/quests/{{$quest->id}}" data-method="delete" data-confirm="{{trans('show.sure')}}">{{trans('show.delete')}}</a>
        @endif
    @endcan
    @if(($quest->state==2)AND(!$quest->execution_id))
        @can('min_level',$quest)
        <a class="btn btn-primary" href="{{action('ExecuteQuestsController@show',[$quest->id])}}">{{trans('show.execute')}}</a>
        @endcan
    @endif
    @if($quest->state==0)
        @can('check_task')
        <a class="btn btn-success" href="/check/publish/{{$quest->id}}" data-token="{{csrf_token()}}" data-method="put" data-confirm="{{trans('show.sure')}}">{{trans('show.publish')}}</a>
        @endcan
    @endif
    @if($quest->state==3)
        @can('task_completion')
        <a class="btn btn-success" href="/check/completion/{{$quest->id}}" data-token="{{csrf_token()}}" data-method="put" data-confirm="Are you sure?">{{trans('show.completion')}}</a>
        @endcan
        @if(($quest->completed<"0001-00-00")AND($quest->execution_id==\Auth::id()))
            <a class="btn btn-primary" href="/quests/done/{{$quest->id}}" data-token="{{csrf_token()}}" data-method="put" data-confirm="{{trans('show.sure')}}">{{trans('show.done')}}</a>
        @endif
    @endif
</div>
@stop

@section('footer')
    <script src="https://cdn.bootcss.com/highlight.js/9.1.0/highlight.min.js"></script>
    <script src="https://cdn.bootcss.com/mathjax/2.6.1/MathJax.js?config=TeX-AMS_HTML"></script>
    <script>
        hljs.initHighlightingOnLoad();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('.quests-markdown table').addClass('table')
        })


        $(function() {

            var laravel = {
                initialize: function() {
                    this.methodLinks = $('a[data-method]');
                    this.token = $('a[data-token]');
                    this.registerEvents();
                },

                registerEvents: function() {
                    this.methodLinks.on('click', this.handleMethod);
                },

                handleMethod: function(e) {
                    var link = $(this);
                    var httpMethod = link.data('method').toUpperCase();
                    var form;

                    // If the data-method attribute is not PUT or DELETE,
                    // then we don't know what to do. Just ignore.
                    if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
                        return;
                    }

                    // Allow user to optionally provide data-confirm="Are you sure?"
                    if ( link.data('confirm') ) {
                        if ( ! laravel.verifyConfirm(link) ) {
                            return false;
                        }
                    }

                    form = laravel.createForm(link);
                    form.submit();

                    e.preventDefault();
                },

                verifyConfirm: function(link) {
                    return confirm(link.data('confirm'));
                },

                createForm: function(link) {
                    var form =
                            $('<form>', {
                                'method': 'POST',
                                'action': link.attr('href')
                            });

                    var token =
                            $('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': link.data('token')
                            });

                    var hiddenInput =
                            $('<input>', {
                                'name': '_method',
                                'type': 'hidden',
                                'value': link.data('method')
                            });

                    return form.append(token, hiddenInput)
                            .appendTo('body');
                }
            };

            laravel.initialize();
        });
    </script>
@endsection
