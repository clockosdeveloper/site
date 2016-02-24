<dd>
    @can('view_profile',$user){{$profile}}@endcan
    @cannot('view_profile',$user)<span class="bg-warning text-warning">{{trans('profile.cannot_view')}}</span> <span class="text-danger">*</span>@endcan
</dd>