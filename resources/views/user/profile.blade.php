@extends('app')

@section('content')
@include('partials.profiles')
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="{{ url('profiles/avatar') }}" class="thumbnail">
                <img src="{{$user->avatar}}" alt="{{$user->username}}">
                <div class="carousel-caption">
                    <h3>{{trans('profile.change')}}</h3>
                </div>
            </a>

        </div>
        <div class="col-xs-6 col-md-6">
            <h2>{{$user->username}}</h2>
            <p>Joined at {{$user->created_at->format('Y-m-d')}} #{{$order}}</p>
            <p>{{$user->email}}&nbsp;</p>
            <p>{{trans('profile.home')}}：<a href="{{$user->blog}}">{{$user->blog}}</a></p>
            <p>GitHub：<a href="{{$user->github}}">{{$user->github}}</a></p>
            <p>{{trans('profile.company')}}：{{$user->company}}</p>
            <p>{{trans('profile.profession')}}：{{$user->profession}}</p>
            <p>{{trans('profile.location')}}：{{$user->location}}</p>
            <p>{{trans('profile.bio')}}：{{$user->introduction}}</p>
        </div>
    </div>
    <div class="form-group">
        <a class="btn btn-primary form-control" href="{{action('ProfilesController@edit',[\Auth::id()])}}">{{trans('profile.edit')}}</a>
    </div>

@stop

@section('footer')
    <script>
        $('.alert-info').delay(3000).slideUp(300);
    </script>
@stop