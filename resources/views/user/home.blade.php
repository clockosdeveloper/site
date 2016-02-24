@extends('app')
@section('stylesheet')
<style type="text/css">
#home-mid-body .col-md-4{
    padding:3px;
}
#home-mid-body .media-body{
    padding-top:5px;
}
#social-links{
    padding: 0;
}
.quest-skill{
    height:50px;
    width:50px;
}
.social-icon{
    height:35px;
    width:35px;
}
</style>
@endsection
@section('content')

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <a href="/about">
                    <img src="{{Clockos\Test::cdn('/img/bg/2.png')}}" alt="...">
                    <div class="carousel-caption">
                        <h3>{{trans('page.about_clockos')}}</h3>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/docs/ways_to_participate_in_clockos">
                    <img src="{{Clockos\Test::cdn('/img/bg/3.png')}}" alt="...">
                    <div class="carousel-caption">
                        <h3>{{trans('page.participate')}}</h3>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/docs/promote">
                    <img src="{{Clockos\Test::cdn('/img/bg/1.png')}}" alt="...">
                    <div class="carousel-caption">
                        <h3>如何带人入clockOS的坑</h3>
                    </div>
                </a>

            </div>
        </div>
    </div>
    <br/>
    <div id="home-mid-body">
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading"><a href="/docs/headlines">{{trans('page.headline')}}</a></div>
                <div class="panel-body">
                    clockOS Developer Version 1.0完成<br/>
                    clockOS Developer 上线<br/>
                    <br/>
                    <br/>
                    <br/>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading"><a href="/docs">{{trans_choice('app.docs',2)}}</a></div>
                <div class="panel-body">
                    <a href="/docs/clockos-intro">了解clockOS</a><br/>
                    <a href="/docs/developer">Developer</a><br/>
                    <a href="/docs/aaaa">4A引擎</a><br/><br/><br/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading"><a href="/status">{{trans('app.status')}}</a></div>
                <div class="panel-body">
                    {{trans('status.members')}}: {{$status->members}}<br/>
                    {{trans('status.stock_week')}}: {{$last_week->stock_d}}@include('partials.vary',['vary' => $last_week->stock_dd])<br/>
                    {{trans('status.members_week')}}: {{$last_week->members_d}}@include('partials.vary',['vary' => $last_week->members_dd])<br/>
                    {{trans('status.quests_done_week')}}: {{$last_week->quests_done_d}}@include('partials.vary',['vary' => $last_week->quests_done_dd])<br/>
                    {{trans('status.stock_trade_week')}}: {{$last_week->stock_trade_d}}@include('partials.vary',['vary' => $last_week->stock_trade_dd])
                </div>
            </div>
        </div>
        @include('partials.developers')
        <div class="col-md-4" style="padding:12px 20px"><i>{{trans('page.ease')}}</i></div>
        <div class="col-md-4 pull-right" style="text-align: right"><a target="_blank" href="https://github.com/clockosdeveloper/clockOS-Developer" data-style="mega" aria-label="Watch clockosdeveloper/clockOS-Developer on GitHub" alt="github:clockosdeveloper" title="github:clockosdeveloper"><img class="social-icon" src="{{Clockos\Test::cdn('/img/other/githublogo.png')}}"></a>

            @if(App::getLocale()=='en')
                <a href="//plus.google.com/u/0/106915227979964796036?prsrc=3"
                   rel="publisher" target="_top" style="text-decoration:none;">
                    <img class="social-icon" src="{{Clockos\Test::cdn('/img/other/gplus.png')}}" alt="Google+"/>
                </a>
            @else<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=31e6fddf9b65dcbbe8be94248e3820081e74d9a521c88e8740abe2b1f701b51d" alt="qq群:301589712" title="qq群:301589712"><img src="{{Clockos\Test::cdn('/img/other/qq.png')}}" class="social-icon"></a>
                <a  alt="微信:clockos" title="微信:clockos" data-toggle="modal" data-target="#myModal"><img class="social-icon" src="{{Clockos\Test::cdn('/img/other/wechat.png')}}"></a>
            @endif
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center">
                    <img src="{{Clockos\Test::cdn('/img/other/qrcode.png')}}"><br/><br/>
                    扫描二维码加入clockOS微信群<br/>
                    或者添加 clockos 为好友<br/>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('footer')
    <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
@endsection
