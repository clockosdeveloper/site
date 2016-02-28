@extends('app')
@section('stylesheet')
    <link href="https://cdn.bootcss.com/iCheck/1.0.1/skins/square/blue.css" rel="stylesheet">
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
                <h3 class="quest-title">{{$decision->title}}</h3><br/>
                @include('partials.decision_state',['state' => $decision->state])
                <br/>

                <br/>
                <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{trans('app.level')}}:{{$decision->min_level}}">
                    <div style="position: relative"><img src="{{\Clockos\Test::cdn('/img/level.png!75')}}" alt="Level" class="quest-skill">
                        <span class="quest-level">Lv.{{$decision->min_level}}</span>
                    </div>
                </a>
                @foreach($decision->departments as $skill)
                    <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$skill->fullname}}">
                        <div><img src="{{\Clockos\Test::cdn($skill->logo.'!75')}}" alt="{{$skill->name}}" class="quest-skill"></div>
                    </a>
                @endforeach
                @foreach($decision->skills as $skill)
                    <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$skill->fullname}}">
                        <div><img src="{{\Clockos\Test::cdn($skill->logo.'!75')}}" alt="{{$skill->name}}" class="quest-skill"></div>
                    </a>
                @endforeach
            </div>
            <div class="col-md-4">
                <img src="{{\Clockos\Test::cdn('/img/decisions/'.$decision->type.'.png')}}">
                <span class="quest-type" style="">{{trans('decision.'.$decision->type)}}</span>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('decision.basic')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table quests-prerequisite">
                <tr>
                    <td>{{trans('decision.creator')}}</td>
                    <td><a href="{{action('ProfilesController@show',[$decision->user->id])}}">{{$decision->user->username}}</a></td>
                </tr>
                <tr>
                    <td>{{trans('decision.created')}}</td>
                    <td>{{$decision->created_at->diffForHumans()}}</td>
                </tr>
                <tr>
                    <td>{{trans('decision.completed')}}</td>
                    <td>{{$decision->completed->diffForHumans()}}</td>
                </tr>
                <tr>
                    <td>{{trans('decision.min_vote')}}</td>
                    <td>{{$decision->min_vote}}</td>
                </tr>
                <tr>
                    <td>{{trans('decision.level')}}</td>
                    <td>{{$decision->min_level}}</td>
                </tr>
                <tr>
                    <td>{{trans('decision.departments')}}</td>
                    <td>
                        @foreach($decision->departments as $item)
                            {{$item->name}}&nbsp;
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>{{trans('decision.skills')}}</td>
                    <td>
                        @foreach($decision->skills as $item)
                            {{$item->name}}&nbsp;
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('decision.details')}}</h3>
        </div>
        <div class="panel-body">
            @can('min_level',$decision)
            <div class="quests-markdown">{!! $decision->body !!}</div>
            @endcan
            @cannot('min_level',$decision)
            <span class="bg-warning text-warning">{{trans('decision.min_level',['level' =>$decision->min_level])}}</span>
            @endcan
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('decision.options')}}</h3>
        </div>
        <div class="panel-body">
            @can('can_vote',$decision)
            @if($decision->state==3)
            @unless($option)
                @include('errors.form')
                {!! Form::open(array('url' => '/decision/vote')) !!}
                @foreach($decision->optionsOrder as $key => $item)
                    <label><input type="radio" name="option" value="{{$item->id}}"> {{$item->title}}</label><br/>
                @endforeach
                <div class="form-group">
                    {!! Form::label('votes',trans('decision.amount')) !!} (1~{{$remain}})
                    {!! Form::input('number','amount',null,['class' => 'form-control','placeholder'=> trans('decision.integer'),'required']) !!}
                    {!! Form::input('hidden','decision_id', $decision->id ,['required']) !!}
                </div>
                <button type="submit" class="btn btn-primary">
                    {{trans('decision.vote')}}
                </button>
                {!! Form::close() !!}
            @endunless
            @endif
            @endcan
            @can('min_level',$decision)
            @if($option)
            @foreach($decision->optionsOrder as $key => $item)
                <div class="progress">
                    <div class="progress-bar
                    @if($key%5==0)
                            progress-bar-success
                    @endif
                    @if($key%5==2)
                            progress-bar-info
                    @endif
                    @if($key%5==3)
                            progress-bar-warning
                    @endif
                    @if($key%5==4)
                            progress-bar-danger
                    @endif
                    @if($item->id==$option->option_id)
                    progress-bar-striped active
                    @endif" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:{{($item->amount/($decision->amount+0.0001))*100}}%;min-width: 10em;">
                        {{$item->title}}
                    </div>
                    {{$item->amount}}
                </div>

            @endforeach
            @endif
            @endcan
            @cannot('min_level',$decision)
            <span class="bg-warning text-warning">{{trans('decision.min_level',['level' =>$decision->min_level])}}</span>
            @endcan
        </div>
    </div>

    <div class="btn-group btn-group-justified col-lg-6" role="group" aria-label="...">
        @can('update',$decision)
        @if($decision->state==3)
            <a class="btn btn-danger" data-token="{{csrf_token()}}" href="/decision/{{$decision->id}}" data-method="delete" data-confirm="Are you sure?">{{trans('decision.delete')}}</a>
        @endif
        @endcan
    </div>
@stop

@section('footer')
    <script src="https://cdn.bootcss.com/highlight.js/9.1.0/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('.quests-markdown table').addClass('table')
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            })
        })


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
