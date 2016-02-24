<div class="form-group">
    {!! Form::label('title',trans('form.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('keyword',trans('doc.keyword')) !!}
    {!! Form::text('keyword', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('permalink',trans('doc.permalink')) !!}
    {!! Form::text('permalink', null, ['class' => 'form-control','required', 'placeholder' => trans('doc.alpha')]) !!}
</div>

<div class="form-group">
    {!! Form::label('lang',trans('doc.lang')) !!}<br/>
    <input type="radio" value="zh" name="lang" @if(App::getLocale()=='zh')checked @endif >{{trans('app.zh')}}
    <input type="radio" value="en" name="lang" @if(App::getLocale()=='en')checked @endif >{{trans('app.en')}}
</div>

<div class="form-group">
    {!! Form::label('department_list',trans('form.departments')) !!}
    {!! Form::select('department_list[]', $departments, null , ['id' => 'department_list','class' => 'form-control','multiple','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('min_level',trans('doc.min_level')) !!}<a href="/quests/11" class="text-success"> !任务 显示有多少开发者的等级大于等于所需的最低等级</a>
    {!! Form::input('number','min_level',null,['class' => 'form-control','placeholder'=> trans('form.integer'),'required']) !!}
</div>


<div class="form-group">
    {!! Form::label('body',trans('form.details')).'(.md)' !!}
    {!! Form::textarea('body', null, ['class' => 'form-control','required', 'rows'=>"8"]) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
<input type="hidden" id="quest-placeholder" value="{{trans('form.search')}}">
@section('footer')
    <script>

        $(document).ready(function(){
            $.fn.select2.defaults.set('language', 'cn');

            $('#department_list').select2([lang="cn"]);

        });
    </script>
@endsection