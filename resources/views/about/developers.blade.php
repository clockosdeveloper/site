@extends('app')
@section('stylesheet')
<style>
.media-object{
    height:100px;
    width: 100px;
    border-radius:150px;
}
.media-heading{
    padding-top: 10px;
}
.col-md-4{
    margin-top:10px;
    margin-bottom:20px;
}
</style>
@endsection
@section('content')
    <h1>Developers</h1>
    <hr/>
    <div class="panel">
        <div class="panel-heading">
            工程师
        </div>
        <div class="panel panel-body">
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/zhang.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">literature</h4>
                        <br/>Mobile部门主管<br/>
                        Java工程师,Android,iOS
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/liu.jpg')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">shiliu</h4>
                        <br/>Search Engine部门主管<br/>
                        延世大学计算机博士,搜索方向
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/fei.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">feivorid</h4>
                        <br/>Developer部门主管<br/>
                        javascript,node.js
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/wang.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">duner</h4>
                        <br/>OS部门主管<br/>
                        Java工程师
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/yu.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">于殿国</h4>
                        <br/>App Builder部门主管<br/>
                        php,laravel
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/diao.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">lancer</h4>
                        <br/>NPL部门主管<br/>
                        东北大学在读研究生
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            运营
        </div>
        <div class="panel panel-body">
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/chen.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">banny</h4>
                        <br/>Finance部门主管<br/>
                        介绍
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/que.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">黑键</h4>
                        <br/>Portal部门主管<br/>
                        成均馆大学心理学专业
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object quest-skill" src="{{Clockos\Test::cdn('/img/developers/2.png')}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Ye1LOVE</h4>
                        <br/>clockOS他妈<br/>
                        无业游民
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            行业顾问
        </div>
        <div class="panel panel-body">

        </div>
    </div>

@stop
