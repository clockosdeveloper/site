@extends('app')
@section('stylesheet')
<style type="text/css">
.logo-mono{
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}
</style>
@endsection
@section('content')
    <h1>{{trans('permission.task_priority')}}</h1>
    <hr/>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{trans('show.skills')}}&middot;
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    @foreach($skills as $item)
                    <a href="/check/priority?skill_id={{$item->id}}" class="test-logo">
                        <img src="{{\Clockos\Test::cdn($item->logo.'!35')}}" class="quests-logo
                        @if(@$_GET['skill_id']!=$item->id)
                                logo-mono
                        @else
                                logo-color
                        @endif
                                " alt="{{$item->name}}" data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <tr>
            <th>{{trans('permission.priority')}}</th>
            <th>{{trans('form.title')}}</th>
            <th>{{trans('form.type')}}</th>
            <th>{{trans('form.state')}}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach($quests as $key => $item)
            <tr>
                <td>{{$item->priority}}</td>
                <td><a href="{{action('QuestsController@show',[$item->id])}}">{{$item->title}}</a></td>
                <td>{{trans('form.'.$item->type)}}</td>
                <td>@include('partials.state',['quest' => $item,'state' => $item->state])</td>
                <td>@unless($key==0)
                        {!! Form::open(array('url' => '/check/priority/move')) !!}
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="move" value="<">
                            <input type="hidden" name="skill_id" value="{{@$_GET['skill_id']?@$_GET['skill_id']:''}}">
                            <button type="submit" class="btn btn-link" style="padding: 0;margin: 0">
                                <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                    @endunless
                </td>
                <td>@unless($key == count($quests)-1)
                        {!! Form::open(array('url' => '/check/priority/move')) !!}
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="move" value=">">
                        <input type="hidden" name="skill_id" value="{{@$_GET['skill_id']?@$_GET['skill_id']:''}}">
                        <button type="submit" class="btn btn-link" style="padding: 0;margin: 0">
                            <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                        </button>
                        {!! Form::close() !!}
                    @endunless
                </td>
                <td>
                        {!! Form::open(array('url' => '/check/priority/open')) !!}
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="move" value=">">
                        <input type="hidden" name="skill_id" value="{{@$_GET['skill_id']?@$_GET['skill_id']:''}}">
                        <button type="submit" class="btn btn-link" style="padding: 0;margin: 0">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                        </button>
                        {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $(".quests-logo").not('.logo-color').on('mouseover',  function() {
                $( this ).removeClass( "logo-mono" );
            }).on('mouseleave', function () {
                $( this ).addClass( "logo-mono" );
            });
        });
    </script>
@endsection