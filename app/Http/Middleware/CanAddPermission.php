<?php

namespace App\Http\Middleware;

use Closure;

class CanAddPermission
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
        if (\Auth::user()->can('add_permission')){
            return $next($request);
        }

        flash()->warning(trans('alert.permission_not_allowed'));

        return redirect('/finance/outcome');
    }
}
