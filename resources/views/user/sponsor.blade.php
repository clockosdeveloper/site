@extends('app')
@section('content')
    @include('partials.profiles')
    <h1>我的介绍人</h1>
    <hr/>

    <div class="panel panel-default">
        <div class="panel-heading">
            @if($sent)已向介绍人发送信息</div>
        <div class="panel-body">

                你已经向介绍人发送了信息，请等待他/她的确认<br/>
                确认之后可以开始管理团队。<br/>
                我的推广代码：<span class="label label-info">{{\Auth::user()->sponsor_code}}</span>

    @else
        请填写介绍人的邮箱或询问他/她的推广代码</div>
        <div class="panel-body">
            <div class="row">
                {!! Form::open( ['onsubmit'=>'return false;']) !!}
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="介绍人的推广代码或邮箱" id="sponsor-code">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="search-sponsor">{{trans('app.search')}}</button>
                  </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                {!! Form::close() !!}
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-6" id="sponsor-result">

                </div>
            </div>
            @endif
        </div>
    </div>
    @unless($sent)
    <div class="panel panel-warning">
        <div class="panel-heading">团队管理</div>
        <div class="panel-body">
            我的推广代码：<span class="label label-info">{{\Auth::user()->sponsor_code}}</span><br/>
            确定你的介绍人后可以管理团队<br/>
            在此之前无法验证谁通过你的介绍加入到了clockOS，请尽快确认你的介绍人。
        </div>
    </div>
    @endunless
    <div class="panel panel-danger">
        <div class="panel-heading">没有介绍人</div>
        <div class="panel-body">
            有介绍人的情况下，分红中的12%会进入到介绍人的帐中。若没有介绍人，分红中的15%会返还回clockOS中。<br/>
            如果有介绍人，请询问他的注册邮箱或推广代码，再到此界面填写。<br/>
            <a href="/docs/sponsor">关于介绍人系统的详情</a>
            <hr/>
            {!! Form::open(['action' => 'TeamsController@confirm' ]) !!}
            <div class="form-group">
                {!! Form::submit('我已了解介绍人系统，确定没有介绍人', ['class' => 'btn btn-danger form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="sponsor-send">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['action' => 'TeamsController@send' ]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">找到了你的介绍人</h4>
                </div>
                <div class="modal-body">
                    向你的介绍人发送验证消息：
                    <input type="text" name="message"><br/>
                    <input type="hidden" name="sponsor_id" value="">
                    <span style="color: orangered">接收者如果没有承认是他/她介绍的话，将不会再有机会确认你的介绍人，是否发送？</span>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input class="btn btn-primary" type="submit" value="发送">
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@stop
@section('footer')
    <script>
        $(document).ready(function () {
            $("#search-sponsor").on('click',function(){
                var code = $("#sponsor-code").val();
                $.ajax({
                    url: '/team/code',
                    type: "post",
                    data: {'sponsor_code':code, '_token': $('input[name=_token]').val()},
                    success: function(data){
                        if(data<-1){
                            var msg = '<div class="alert alert-danger alert-important" role="alert">没有找到该介绍人，还可以查找<span style="color:red">'+(-1-data)+'</span>次。请仔细确认你的介绍人的邮箱或推广代码，若介绍人隐私设置为无法通过邮箱查找，请填写推广代码</div>';
                            $("#sponsor-result").html(msg)
                        }else if(data==-1){
                            window.location.replace('/team');
                        }else if(data>0){
                            $("input[name='sponsor_id']").val(data);
                            $('#sponsor-send').modal()
                        }
                    }
                });
            });
        });

    </script>
@stop