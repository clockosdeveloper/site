{!! Form::open(['action' => 'SkillsController@store' ]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{trans('alert.select_sub_skill')}}</h4>
</div>
<div class="modal-body radio">
    @foreach($skills as $skill)
        <label>
        <div style="vertical-align: middle;display: inline-block">
            @if($skill->logo)<div><img src="{{\Clockos\Test::cdn($skill->logo)}}" class="skill"></div>@endif
            <div style="text-align: center"><input type="radio" value="{{$skill->id}}" name="subskill">{{$skill->name}}&nbsp;</div>
        </div>
        </label>
    @endforeach
</div>
<div class="modal-footer">
    <p style="display: inline-block;" class="text-danger bg-danger"><span style="display: none" id="alert-message">{{trans('alert.skill_confirm')}}</span></p>
    <button type="button" class="btn btn-default" data-dismiss="modal" style="display: none" id="cancel">{{trans('app.cancel')}}</button>
    <button type="button" class="btn btn-primary" id="confirm">{{trans('app.select')}}</button>
    <button type="submit" class="btn btn-warning" id="sure" style="display: none">{{trans('app.ok')}}</button>
</div>
{!! Form::close() !!}