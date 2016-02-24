@extends('app')
@section('content')
<h1>{{trans('permission.check_task')}}</h1><hr/>
<table class="table table-hover">
    <tr>
        <th>id</th>
        <th>{{trans('form.title')}}</th>
        <th>{{trans('app.user')}}</th>
        <th>{{trans('form.type')}}</th>
        <th>{{trans('app.user')}}{{trans('app.level')}}</th>
    </tr>
    @foreach($quests as $item)
        <tr>
            <td>#{{$item->id}}</td>
            <td><a href="{{action('QuestsController@show',[$item->id])}}">{{$item->title}}</a></td>
            <td><a href="{{action('ProfilesController@show',[$item->user->id])}}">{{$item->user->username}}</a></td>
            <td>{{trans('form.'.$item->type)}}</td>
            <td>{{$item->user->level}}</td>
        </tr>
    @endforeach
</table>
<div class="col-md-12" style="text-align: center">{!! $quests->appends(Request::except('page'))->render()!!}</div>
@endsection
@section('footer')
@endsection