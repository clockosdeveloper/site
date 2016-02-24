<ul class="nav nav-tabs" style="margin-bottom: 15px">
    <li role="presentation" class="{{ ($current_route_name == 'profiles') ? 'active' : '' }}"><a href="{{ url('/profiles') }}">我的状态</a></li>
    <li role="presentation" class="{{ ($current_route_name == 'roles') ? 'active' : '' }}"><a href="{{ url('/roles') }}">clockOS</a></li>
    <li role="presentation" class="{{ ($current_route_name == 'team') ? 'active' : '' }}"><a href="{{ url('/team') }}">团队</a></li>
</ul>