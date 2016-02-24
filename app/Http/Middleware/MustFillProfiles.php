<?php

namespace App\Http\Middleware;

use Closure;

class MustFillProfiles
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

        $user = $request->user();

        if($user && $user->skills()->exists()) {
            return $next($request);
        }

        session()->put('redirect',$request->path());//把本要访问的地址存在会话中，职业选好以后跳转到原先要去的地方

        flash()->info(trans('alert.select_skill'));

        return redirect('/roles/skills');

    }
}
