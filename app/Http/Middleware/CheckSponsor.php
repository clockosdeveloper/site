<?php

namespace App\Http\Middleware;

use Closure;
use App\SponsorConfirm;

class CheckSponsor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //检查用户是否确认了谁是他的介绍人
        if(((\Auth::user()->sponsor_id)>-2)){
            return $next($request);
        };




        if((SponsorConfirm::where('user_id',\Auth::id())->exists())){

            flash()->success('已向介绍人发送信息，请等待介绍人的回应');

        }else{

            flash()->info('管理团队之前，请填写你介绍者的推广代码或是邮箱');
        }

        return redirect('/team/sponsor');

    }
}
