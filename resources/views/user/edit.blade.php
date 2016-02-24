@extends('app')

@section('content')
@include('partials.profiles')
<h1>{{trans('profile.edit')}}</h1>
{!! Form::model($user,['method' => 'PATCH', 'action' => ['ProfilesController@update', $user->id ]]) !!}
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.username')}}</label>
            {!! Form::text('username', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.home')}}</label>
            {!! Form::text('blog', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">GitHub</label>
            {!! Form::text('github', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.company')}}</label>
            {!! Form::text('company', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.profession')}}</label>
            {!! Form::text('profession', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.location')}}</label>
            {!! Form::text('location', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label id="basic-addon1">{{trans('profile.bio')}}</label>
            {!! Form::textarea('introduction', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit(trans('form.submit'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
@include('errors.form')

@stop

@section('footer')
    <script>
        $('.alert-info').delay(3000).slideUp(300);
    </script>
@stop