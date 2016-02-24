<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $profile)
    {
        //检查用户是否填了此选项
        if(\Auth::user()->$profile){
            return $next($request);
        };

        session()->put('redirect',$request->path());//把本要访问的地址存在会话中，职业选好以后跳转到原先要去的地方

        if($profile=='sponsor_id'){
            flash()->info('请填写你介绍者的推广代码或是邮箱');
            return redirect('/team/sponsor');
        };

    }
}
