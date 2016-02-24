@extends('app')
@section('content')
    <h1>{{trans('decision.create')}}</h1>
    <hr/>
    @include('errors.form')
    {!! Form::open(['action' => 'DecisionsController@store' ]) !!}

    <div class="form-group">
        {!! Form::label('title',trans('decision.title')) !!}
        {!! Form::text('title', null, ['class' => 'form-control','required']) !!}
    </div>
    <div class="form-group" id="quest-types">
        {!! Form::label('type',trans('decision.type')) !!}
        <div class="radio">
            <label>
                {!! Form::radio('type',  'feature') !!}{{trans('decision.feature')}}
            </label>
            <label>
                {!! Form::radio('type',  'tech') !!}{{trans('decision.tech')}}
            </label>
            <label>
                {!! Form::radio('type',  'capital') !!}{{trans('decision.capital')}}
            </label>
            <label>
                {!! Form::radio('type',  'invest') !!}{{trans('decision.invest')}}
            </label>
            <label>
                {!! Form::radio('type',  'price') !!}{{trans('decision.price')}}
            </label>
            <label>
                {!! Form::radio('type',  'stock') !!}{{trans('decision.stock')}}
            </label>
            <label>
                {!! Form::radio('type',  'service') !!}{{trans('decision.service')}}
            </label>
            <label>
                {!! Form::radio('type',  'rebuild') !!}{{trans('decision.rebuild')}}
            </label>
            <label>
                {!! Form::radio('type',  'appoint') !!}{{trans('decision.appoint')}}
            </label>
            <label>
                {!! Form::radio('type',  'other') !!}{{trans('decision.other')}}
            </label>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('department_list',trans('decision.departments')) !!}
        {!! Form::select('department_list[]', $departments, null , ['id' => 'department_list','class' => 'form-control','multiple','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('skill_list',trans('decision.skills')) !!}
        {!! Form::select('skill_list[]', $skills, null , ['id' => 'skill_list','class' => 'form-control','multiple','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('min_vote',trans('decision.min_vote')) !!}&nbsp;&nbsp;&nbsp;<span id="stock"></span>
        {!! Form::input('number','min_vote',null,['class' => 'form-control', 'data-placement' => 'bottom', 'data-toggle' => 'popover','title' => trans('decision.hint'),'data-content'=>trans('decision.hint-content'),'placeholder'=> trans('decision.integer'),'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('days',trans('decision.completed')) !!}
        {!! Form::input('number','days',null,['class' => 'form-control','placeholder'=> trans('decision.integer'),'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('min_level',trans('decision.level')) !!}<a href="/quests/11" class="text-success"> !任务 显示有多少开发者的等级大于等于所需的最低等级</a>
        {!! Form::input('number','min_level',null,['class' => 'form-control','placeholder'=> trans('decision.integer'),'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body',trans('decision.details')).'(.md)' !!}
        {!! Form::textarea('body', null, ['class' => 'form-control','required', 'rows'=>"4"]) !!}
    </div>
    <label>{{trans('decision.options')}}</label>
    <div class="form-group">
        <input type="text" class="form-control" name="options[]" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="options[]" required>
    </div>
    <div id="more-options">
    </div>
    <div class="form-group">
        <button class="btn btn-success" id="add-option">{{trans('decision.add')}}<span class="glyphicon glyphicon-plus-sign" style="font-size:12px;"></span></button>
    </div>
    <div class="form-group">
        {!! Form::submit(trans('decision.create'), ['class' => 'btn btn-primary form-control']) !!}
    </div>


    {!! Form::close() !!}

@stop

@section('footer')
    <script>

        $(document).ready(function(){
            $.fn.select2.defaults.set('language', 'cn');

            $('#department_list,#skill_list').select2([lang="cn"]);

            $('#add-option').on('click',function(e){
                e.preventDefault();
                $('#more-options').append(append);
                $('.remove-one-option').on('click',function(){
                    $(this).closest('.form-group').remove();
                    addOptionButtion();
                });
                addOptionButtion();
            });

            var addOptionButtion = function(){
                var numberOfOptions = $('.remove-one-option').length;
                if(numberOfOptions > 7){
                    $('#add-option').hide();
                }else{
                    $('#add-option').show();
                }
            };


            var append = '<div class="form-group"><div class="input-group"><span class="input-group-btn"><button class="btn btn-default remove-one-option" type="button"><span class="glyphicon glyphicon-minus-sign" style="font-size:13px;"></span></button></span><input type="text" class="form-control" name="options[]" required></div></div>';

        });
    </script>
@endsection