<?php

namespace App\Http\Controllers;

use App\Jobs\EmailSponsorFound;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use App\SponsorConfirm;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sponsor',['only' => ['index']]);
    }

    public function index(SponsorConfirm $confirm)
    {
        //我的介绍人
        $data['mySponsor'] = \DB::table('users as t1')->
        select('t2.username','t2.id')->
        leftjoin('users AS t2', 't2.id', '=', 't1.sponsor_id')->
        where('t1.id', \Auth::id())->
        where('t1.sponsor_id', '>', '0')->
        first();

        //把我作为介绍人等待我确认的
        $data['confirms'] = $confirm->ConfirmList();


        //我的成员
        $data['members'] =User::where('sponsor_id',\Auth::id())->get();

        //成员数量
        $data['members_num'] =User::where('sponsor_id',\Auth::id())->count();

        return view('user.team',$data);
    }

    public function sponsor()
    {

        $sent = SponsorConfirm::where('user_id',\Auth::id())->exists();//檢查是否已向介绍人发送信息

        return view('user.sponsor',compact('sent'));
    }

    public function search(Request $request)
    {
        $input = $request->all();

        //检查有没有此推广代码

        $code = User::where('sponsor_code',$input['sponsor_code'])->where('id','!=',\Auth::id())->first();

        if($code){
            return $code->id;
        }

        //检查有没有此邮箱

        $code = \DB::table('users')
                ->join('settings', 'users.id', '=', 'settings.user_id')
                ->where('users.id','!=',\Auth::id())    //不能是用户自己
                ->where('settings.sponsor_code',1)     //用户隐私设置为可以通过邮箱找到
                ->where('users.email',$input['sponsor_code'])
                ->first();

        if($code){
            return $code->id;
        }

        $num = \Auth::user()->sponsor_id;   //用户还可以验证的次数

        if($num > -2 ){
            flash()->info('查找次数已达5次，介绍关系已确定，你现在可以管理团队了。')->important();
            return ($num);
        }

        \Auth::user()->update(['sponsor_id'=>$num+1]);  //减少一次还可以验证的次数

        return ($num);

    }


    //用户确定没有介绍人
    public function confirm()
    {

        \Auth::user()->update(['sponsor_id'=>(-1)]);  //减少一次还可以验证的次数

        //删除表中的请求信息
        SponsorConfirm::where('user_id',\Auth::id())
            ->delete();

        flash()->info(trans('alert.no_sponsor'))->important();

        return redirect('/team');

    }


    public function update()
    {
        return view('user.sponsor');
    }

    public function send(Request $request)
    {
        $this->validate($request,[
            'sponsor_id' => 'required|numeric'
        ]);

        $send = $request->all();

        $send['user_id'] = \Auth::id();

        $user = User::find($send['sponsor_id']);

        SponsorConfirm::create($send);

        $this->dispatch(new EmailSponsorFound($user,$send['message']));

        return redirect('/team');
    }

    public function accept(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required|numeric',
            'accept' => 'required'
        ]);

        $data = $request->all();

        //承认介绍关系
        if($data['accept']=='accept'){
            if((User::where('sponsor_id',\Auth::id())->count())>=(\Auth::user()->sponsor_max)){
                return trans('alert.max_teammate');
            }
            User::where('id',$data['user_id'])
                ->update(['sponsor_id'=>\Auth::id()]);
        }

        //不承认介绍关系
        if($data['accept']=='deny'){
            User::where('id',$data['user_id'])
                ->update(['sponsor_id'=>-1]);
        }

        //删除表中的请求信息
        SponsorConfirm::where('user_id',$data['user_id'])
            ->delete();

        return redirect('/team');

    }
}
