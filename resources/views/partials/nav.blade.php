<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" id="logo-top"><img alt="clockOS Developer" src="{{Clockos\test::cdn('/img/logo.png')}}" height="50px;" width="200px"></a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">


            <ul class="nav navbar-nav navbar-right">

                <li>@if(App::getLocale()=='en')<a href="/language/zh"><span class="glyphicon glyphicon-text-background" style="font-size:11px"></span> 中文(简体)
                    @else
                            <a href="/language/en"><span class="glyphicon glyphicon-text-background" style="font-size:11px"></span> English(US)
                    @endif
                    </a>
                </li>
                @if(Auth::guest())
                    <li><a href="/auth/login"><span class="glyphicon glyphicon-log-in" style="font-size:12px"></span> {{trans('auth.login')}}</a></li>
                @endif
                @unless(Auth::guest())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img class="nav-gravatar" src="{{$avatar}}">

                        <span style="float:left;margin-right:15px"><span class="caret"></span>  {{\Auth::user()->username}} @if($notifications_number>0)<span class="badge">{{$notifications_number}}</span>@endif</span>

                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/notifications') }}"><span class="glyphicon glyphicon-globe"></span>{{trans_choice('app.notification',$notifications_number)}} <span class="badge">{{$notifications_number}}</span></a></li>
                        <li><a href="{{ url('/profiles') }}"><span class="glyphicon glyphicon-user"></span>{{trans('app.profiles')}}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('/settings') }}"><span class="glyphicon glyphicon-cog"></span>{{trans('app.settings')}}</a></li>
                        <li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-log-out"></span>{{trans('app.logout')}}</a></li>
                    </ul>
                </li>


                </ul>
                <ul class="nav navbar-nav">
                    <li class="{{ ($current_route_name == 'quests') ? 'active' : '' }}"><a href="{{ url('/quests') }}">{{trans('app.project')}}</a></li>
                    <li class="{{ ($current_route_name == 'finance') ? 'active' : '' }}"><a href="{{ url('/finance') }}">{{trans('app.finance')}}</a></li>
                    <li class="{{ ($current_route_name == 'decision') ? 'active' : '' }}"><a href="{{ url('/decision') }}">{{trans('app.decision')}}</a></li>
                    <li class="{{ ($current_route_name == 'status') ? 'active' : '' }}"><a href="{{ url('/status') }}">{{trans('app.status')}}</a></li>
                    <li class="{{ ($current_route_name == 'manage') ? 'active' : '' }}"><a href="{{ url('/manage') }}">{{trans('app.manage')}}</a></li>

                </ul>

                @endunless

        </div><!--/.nav-collapse -->

    </div>
</nav>