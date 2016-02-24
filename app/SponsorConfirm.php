<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;

class SponsorConfirm extends Model
{
    protected $table = 'sponsor_confirm';

    protected $fillable = ['user_id','sponsor_id','message'];

    protected static function boot()
    {
        parent::boot();

        static::created(function($confirm_request){
            Notification::create([
                'title' => 'sponsor',       //通知的主题
                'body'  => '/team/sponsor', //通知所指向的链接
                'user_id' => $confirm_request->sponsor_id //被当做介绍人的用户收到此通知
            ]);
        });
    }

    /**
     * 查看把当前用户当做介绍人的名单
     */

    public function ConfirmList()
    {
        return \DB::table('sponsor_confirm as t1')->
        join('users AS t2', 't2.id', '=', 't1.user_id')->
        where('t1.sponsor_id', \Auth::id())->
        get();
    }

}
