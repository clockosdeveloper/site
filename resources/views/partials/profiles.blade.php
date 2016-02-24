<ul class="nav nav-tabs" style="margin-bottom: 15px">
    <li role="presentation" class="{{ ($current_route_name == 'profiles') ? 'active' : '' }}"><a href="{{ url('/profiles') }}">{{trans('app.profiles')}}</a></li>
    <li role="presentation" class="{{ ($current_route_name == 'roles') ? 'active' : '' }}"><a href="{{ url('/roles') }}">{{trans('app.role')}}</a></li>
    <li role="presentation" class="{{ ($current_route_name == 'team') ? 'active' : '' }}"><a href="{{ url('/team') }}">{{trans('app.team')}}</a></li>
</ul>