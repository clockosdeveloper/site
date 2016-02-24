@extends('app')

@section('content')
    <div class="panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('app.user_profiles')}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.username')}}</dt>
                    <dd>{{$user->username}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('app.position')}}</dt>
                    <dd>{{trans('manage.'.$role->name)}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('app.level')}}</dt>
                    <dd>{{$user->level}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('app.join_date')}}</dt>
                    <dd>{{$user->created_at}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('app.stock')}}</dt>
                    @include('partials.view_profile',['profile' => $user->stock])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('app.vote')}}</dt>
                    @include('partials.view_profile',['profile' => $user->vote])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.home')}}</dt>
                    <dd><a href="{{$user->blog}}">{{$user->blog}}</a></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>GitHub</dt>
                    <dd><a href="{{$user->github}}">{{$user->github}}</a></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('auth.email')}}</dt>
                    @include('partials.view_profile',['profile' => $user->email])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.company')}}</dt>
                    @include('partials.view_profile',['profile' => $user->company])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.profession')}}</dt>
                    @include('partials.view_profile',['profile' => $user->profession])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.location')}}</dt>
                    @include('partials.view_profile',['profile' => $user->location])
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('show.skills')}}</dt>
                    <dd>
                        @foreach($user->skills as $skill)
                            <img src="{{Clockos\Test::cdn($skill->logo.'!75')}}" class="quests-logo" alt="{{$skill->name}}">
                        @endforeach
                    </dd>

                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('profile.bio')}}</dt>
                    <dd>{{$user->introduction}}</dd>
                </dl>
            </div>

            <hr>
            <span class="text-danger">*</span>&nbsp;{{trans('profile.hint')}}

        </div>
    </div>

@stop
