@if($state=="3")
<span class="glyphicon glyphicon-play difficulty-text-1" aria-hidden="true"></span><span class="difficulty-text-1">
@endif
@if($state=="4")
<span class="glyphicon glyphicon-stop difficulty-text-5" aria-hidden="true"></span><span class="difficulty-text-5">
@endif
{{trans('decision.'.$state)}}
</span>