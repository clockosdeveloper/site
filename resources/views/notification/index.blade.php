@extends('app')

@section('content')
    <h1>{{trans_choice('app.notification',2)}}</h1><hr/>
    <div class="list-group">
    @foreach($notifications as $notification)
        <a href="{{ action('NotificationsController@show',[$notification->id]) }}" class="list-group-item">
            <h4 class="list-group-item-heading">
                @unless($notification->isread)
                    <span class="label label-danger">New</span>
                @endunless
                {{ trans('notification.'.$notification->title) }}
            </h4>
            <p class="list-group-item-text">
                {!! Form::open(['action' => ['NotificationsController@destroy', $notification->id], 'method' => 'DELETE']) !!}
                <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Form::close() !!}
                <span class="glyphicon glyphicon-time" style="font-size:13px"></span> {{ $notification->updated_at->diffForHumans() }}
            </p>

        </a>
    @endforeach
    </div>
@stop