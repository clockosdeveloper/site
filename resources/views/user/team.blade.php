@extends('app')
@section('content')
    <h1>{{trans('app.manage')}}</h1>
    <hr/>
    <ul class="nav nav-tabs" style="margin-bottom: 15px">
        <li role="presentation"><a href="{{ url('/manage') }}">clockOS</a></li>
        <li role="presentation" class="active"><a href="{{ url('/team') }}">{{trans('app.team')}}</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('app.manage')}}</div>
        <div class="panel-body">
            @if($mySponsor)
                我的介绍人：<a href="/profiles/{{$mySponsor->id}}">{{$mySponsor->username}}</a><br/>
            @endif
            {{trans('profile.promocode')}}&nbsp;&nbsp;&nbsp;<span class="label label-info">{{\Auth::user()->sponsor_code}}</span><br/>
            <div class="form-group">
                <input type="checkbox" data-setting="sponsor_code" class="settings-switch" {{Clockos\CheckedOrNot::setting('sponsor_code')}} >{{trans('profile.findbyemail')}}<br/><span id="sponsor-msg"></span>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">团队成员({{$members_num}}/{{\Auth::user()->sponsor_max}})</div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>成员</th>
                    <th>{{trans('auth.email')}}</th>
                    <th>{{trans('app.level')}}</th>
                    <th>{{trans('app.exp')}}</th>
                    <th>{{trans_choice('app.stock',2)}}</th>
                    <th>{{trans('app.vote')}}</th>
                </tr>
                @foreach($members as $member)
                <tr>
                    <td><a href="/profiles/{{$member->id}}"> {{$member->username}}</a></td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->level}}</td>
                    <td class="experience">{{$member->experience}}</td>
                    <td class="stock">{{$member->stock}}</td>
                    <td class="vote">{{$member->vote}}</td>
                </tr>
                @endforeach
                <tr>
                    <td>合计</td>
                    <td></td>
                    <td>-</td>
                    <td id="total-experience"></td>
                    <td id="total-stock"></td>
                    <td id="total-vote"></td>
                </tr>
            </table>
            <hr/>
            当前可额外享受<span id="my-extra-stock" style="color: orangered"></span>股的分红<br/>
            成员数上限:5+{{\Auth::user()->sponsor_max-5}}={{\Auth::user()->sponsor_max}}
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-heading">等待我确认的成员</div>
        <div class="panel-body">
            @if((\Auth::user()->sponsor_max)<=$members_num)
                成员数已达到上限，在现有成员获得更多的经验或股权时可以再添加成员，请帮助他们获得更多。
            @endif
            <table class="table table-striped">
                <tr>
                    <th>成员</th>
                    <th>{{trans('auth.email')}}</th>
                    <th>留言</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($confirms as $member)
                    <tr>
                        <td><a href=""> {{$member->username}}</a></td>
                        <td>{{$member->email}}</td>
                        <td>{{$member->message}}</td>
                        @if((\Auth::user()->sponsor_max)<=$members_num)
                        <td></td><td></td>
                            @else
                            <td><a href="" data-sponsor="accept" data-id="{{$member->user_id}}" data-toggle="modal" data-target="#sponsor-decide">是我介绍的</a></td>
                            <td><a href="" data-sponsor="deny" data-id="{{$member->user_id}}" data-toggle="modal" data-target="#sponsor-decide" >不是我介绍的</a></td>
                            @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

<div class="modal fade" id="sponsor-decide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['action' => 'TeamsController@accept']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">确认介绍人关系</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('app.cancel')}}</button>
                <input type="submit" class="btn btn-primary" value="{{trans('app.ok')}}">
                <input type="hidden" name="accept">
                <input type="hidden" name="user_id">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('footer')
    <script>
        $(document).ready(function () {
            $(".settings-switch").on('change', function () {
                $(this).attr("disabled", true);
                var setting = $(this).data('setting');
                var clicked = $(this);
                $.ajax({
                    url: '/setting/switch',
                    type: "post",
                    data: {'type':setting, '_token': $('input[name=_token]').val()},
                    success: function(data){
                        if(data==1){
                            $("#sponsor-msg").html('<span class="bg-success text-success">已开启通过邮箱查找到我</span>');
                        }else{
                            $("#sponsor-msg").html('<span class="bg-danger text-danger">已关闭通过邮箱查找到我</span>');
                        }
                        clicked.removeAttr("disabled");
                    }
                });
            });

            var experience = 0;
            $('.experience').each(function(){
                experience += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
            });

            $("#total-experience").html(experience);

            var stock = 0;
            $('.stock').each(function(){
                stock += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
            });

            $("#total-stock").html(stock);

            $("#my-extra-stock").html(parseInt(stock *.12));

            var vote = 0;
            $('.vote').each(function(){
                vote += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
            });

            $("#total-vote").html(vote);

            $('#sponsor-decide').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('id') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                var content = ''
                var accept = button.data('sponsor')
                if(accept=='deny'){
                    var content = '请再次确定此用户不是你介绍的，你的决定将影响此用户的收益'
                }else{
                    var content = '请再次确定此用户是你介绍的，介绍关系一旦确立无法取消'
                }

                modal.find("input[name='user_id']").val(recipient)
                modal.find("input[name='accept']").val(accept)
                modal.find('.modal-body').html(content)
            })

        });


    </script>
@stop