<div id="home-mid-body">
    <div class="col-md-4">
        <div class="panel panel-default ">
            <div class="panel-heading"><a href="#">Headlines</a></div>
            <div class="panel-body">
                <a href="#">Basic panel example</a><br/>
                <a href="#">Basic panel example</a><br/>
                <a href="#">Basic panel example</a><br/>
                <a href="#">Basic panel example</a><br/>
                <a href="#">Basic panel example</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default ">
            <div class="panel-heading"><a href="/docs">{{trans_choice('app.docs',2)}}</a></div>
            <div class="panel-body">
                <a href="#">Basic panel example</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default ">
            <div class="panel-heading"><a href="/status">{{trans('app.status')}}</a></div>
            <div class="panel-body">
                {{trans('status.members')}}: {{$status->members}}<br/>
                {{trans('status.quests_done_week')}}: {{$last_week->quests_done_d}}
            </div>
        </div>
    </div>
    <div class="panel panel-default col-md-12" id="social-links">
        <div class="panel-heading"><a href="/status">{{trans_choice('app.developer',3)}}</a></div>
        <div class="panel-body">
            <div class="col-md-3">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/avatar/android.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading</h4>
                        lksdjflkadsjfaldsfasdfasddddddddddddddddddsdsdssdfasdddddddddddddddddddddasfasfasdfasdfffffffffffffffffffffffffffffffffffffffffffff
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/avatar/android.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading</h4>
                        lksdjflkadsjfaldsfasdfasddddddddddddddddddsdsdsddddddddddddddddddddasfasfasdffasddddddddddddddddddsdsdssdfasdddddddddddddddddddddasfasfasdfasdfffffffffffffffff
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/avatar/android.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading</h4>
                        lksdjflkadsjfaldsfasdfasddddddddddddddddddsdsdsddddddddddddddddddddasfasfasdffasddddddddddddddddddsdsdssdfasdddddddddddddddddddddasfasfasdfasdfffffffffffffffff
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/avatar/android.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading</h4>
                        lksdjflkadsjfaldsfasdfasddddddddddddddddddsdsdsddddddddddddddddddddasfasfasdffasddddddddddddddddddsdsdssdfasdddddddddddddddddddddasfasfasdfasdfffffffffffffffff
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <br/><hr/>
                <div class="col-md-3">
                    <a class="github-button" href="https://github.com/clockosdeveloper/clockOS-Developer" data-style="mega" aria-label="Watch clockosdeveloper/clockOS-Developer on GitHub">clockOS-Developer
                    </a>
                </div>
                <div class="col-md-3">
                    @if(App::getLocale()=='zh')
                        <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=31e6fddf9b65dcbbe8be94248e3820081e74d9a521c88e8740abe2b1f701b51d"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="clockOS" title="clockOS">
                        </a>
                    @else
                        <a href="//plus.google.com/u/0/106915227979964796036?prsrc=3"
                           rel="publisher" target="_top" style="text-decoration:none;">
                            <img src="//ssl.gstatic.com/images/icons/gplus-32.png" alt="Google+" style="border:0;width:32px;height:32px;"/>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>