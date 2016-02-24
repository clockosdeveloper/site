@extends('app')
@section('content')
    <h1>{{trans('finance.add_outcome')}}</h1>
    <hr/>
    @include('errors.form')
    {!! Form::open(['action' => 'OutcomesController@store' ]) !!}

    <div class="form-group">
        {!! Form::label('title',trans('finance.title')) !!}
        {!! Form::text('title', null, ['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group" id="quest-types">
        {!! Form::label('type',trans('finance.type')) !!}
        <div class="radio">
            <label>
                {!! Form::radio('type',  'hardware') !!}{{trans('finance.hardware')}}
            </label>
            <label>
                {!! Form::radio('type',  'software') !!}{{trans('finance.software')}}
            </label>
            <label>
                {!! Form::radio('type',  'service') !!}{{trans('finance.service')}}
            </label>
            <label>
                {!! Form::radio('type',  'salary') !!}{{trans('finance.salary')}}
            </label>
            <label>
                {!! Form::radio('type',  'other') !!}{{trans('finance.other')}}
            </label>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('price',trans('finance.price')) !!}
        {!! Form::input('text','price',null,['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('amount',trans('finance.amount')) !!}
        {!! Form::input('number','amount',null,['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('provider',trans('finance.provider')) !!}
        {!! Form::text('provider', null, ['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('start',trans('finance.start')) !!}
        {!! Form::input('date','start',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('end',trans('finance.end')) !!}
        {!! Form::input('date','end',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body',trans('form.details')).'(.md)' !!}
        {!! Form::textarea('body', null, ['class' => 'form-control','required', 'rows'=>"4"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit(trans('finance.add_outcome'), ['class' => 'btn btn-primary form-control']) !!}
    </div>


    {!! Form::close() !!}

@stop