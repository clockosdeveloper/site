@extends('app')
@section('stylesheet')
<style type="text/css">
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
            <h3 class="quest-title">{{Clockos\DualLang::lang($doc->title,$doc->entitle)}}</h3>
            <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{trans('app.level')}}:{{$doc->min_level}}">
                <div style="position: relative"><img src="{{\Clockos\Test::cdn('/img/level.png!75')}}" alt="Level" class="quest-skill">
                    <span class="quest-level">Lv.{{$doc->min_level}}</span>
                </div>
            </a>

            @foreach($doc->departments as $item)
                <a style="vertical-align: middle;display: inline-block" href="#" data-toggle="tooltip" data-placement="bottom" title="{{$item->fullname}}">
                    <div><img src="{{\Clockos\Test::cdn($item->logo.'!75')}}" alt="{{$item->name}}" class="quest-skill"></div>
                </a>
            @endforeach
            <hr/>
            @can('min_level',$doc)
            @if($doc->min_level>1)
                <div class="quests-markdown">{!!Clockos\DualLang::lang($doc->body,$doc->enbody)!!}</div>
            @endif
            @endcan
            @if($doc->min_level<2)
                <div class="quests-markdown">{!!Clockos\DualLang::lang($doc->body,$doc->enbody)!!}</div>
            @endif
            @cannot('min_level',$doc)
            @if($doc->min_level>1)
                <span class="bg-warning text-warning">{{trans('show.min_level',['level' =>$doc->min_level])}}</span>
            @endif
            @endcan
        </div>
    </div>

<div class="btn-group btn-group-justified col-lg-6" role="group" aria-label="...">
    @can('edit_document')
        @if($doc->state==0)
            <a class="btn btn-primary" href="{{action('DocsController@edit',[$doc->id])}}">{{trans('show.change')}}</a>
            <a class="btn btn-danger" data-token="{{csrf_token()}}" href="/docs/{{$doc->id}}" data-method="delete" data-confirm="{{trans('show.sure')}}">{{trans('doc.delete')}}</a>
        @endif
    @endcan
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
