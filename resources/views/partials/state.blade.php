@if($state=="0")
<span class="glyphicon glyphicon-lock difficulty-text-5" aria-hidden="true"></span><span class="difficulty-text-5">
@endif
@if($state=="1")
<span class="glyphicon glyphicon-time difficulty-text-4" aria-hidden="true"></span><span class="difficulty-text-4">
@endif
@if($state=="2")
<span class="glyphicon glyphicon-folder-open difficulty-text-2" aria-hidden="true"></span><span class="difficulty-text-2">
@endif
@if($state=="3")
<span class="glyphicon glyphicon-play difficulty-text-3" aria-hidden="true"></span><span class="difficulty-text-3">
@endif
@if($state=="4")
<span class="glyphicon glyphicon-ok difficulty-text-1" aria-hidden="true"></span><span class="difficulty-text-1">
@endif
{{trans('form.'.$state)}}
</span>
&nbsp;
@if($quest->user_id==\Auth::id())
    [{{trans('show.created_by')}}]
@endif
@if($quest->checker_id==\Auth::id())
    [{{trans('show.checked')}}]
@endif
@if($quest->execution_id==\Auth::id())
    [{{trans('show.executing')}}]
@endif
@if($quest->final_checker_id==\Auth::id())
    [{{trans('show.final_checked_by')}}]
@endif
